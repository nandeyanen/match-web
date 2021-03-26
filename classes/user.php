<?php
require_once "database.php";

class User extends Database{

    private $candidate = [] ; // for getOneCandidate
    private $match_list; // for setMatchlist
    private $messages; // for getMeesages
    private $matched_user ; // for set/getMatchedUser

    public function createUser($gender,$username,$email,$date_of_birth,$image_name,$image_tmp,$introduction,$password){
        $introduction = $this->conn->real_escape_string($introduction);
        // sql
        $sql = "INSERT INTO users (username, email, gender, date_of_birth,`image`, introduction, `password`)  VALUES ('$username','$email','$gender','$date_of_birth','$image_name','$introduction','$password')";

        // WHAT IF A IMAGE FILE THAT HAS SAME NAME IS UPLOADED?

        // exucute
        if ($this->conn->query($sql)) {

            // bring photo into ..img/
            $destination = "../img/" . basename($image_name);
            if(move_uploaded_file($image_tmp,$destination)){
                header("location: ../views/login.php");
                exit;
            }else{
                die("Error uploading image ".$this->conn->error);
            }
        }else{
            die("Error creating user: ".$this->conn->error);
        }
    }

    public function login($username,$password){
        $now = date('Y/m/d H:i:s');
        // sql
        $error = "The username or password you entered is incorrect";
        $sql = "SELECT * FROM users WHERE username = '$username' ";

        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $user_details = $result->fetch_assoc();
            if (password_verify($password,$user_details['password'])) {
                session_start();

                $_SESSION['id'] = $user_details['user_id'];
                $_SESSION['username'] = $user_details['username'];
                $_SESSION['image_name'] = $user_details['image'];
                $_SESSION['gender'] = $user_details['gender'];
                $_SESSION['date_of_birth'] = $user_details['date_of_birth'];
                $_SESSION['introduction'] = $user_details['introduction'];
                $_SESSION['email'] = $user_details['email'];
                $_SESSION['password'] = $user_details['password'];
                $_SESSION['age'] = $now - $user_details['date_of_birth'];

                header("location: ../views/dashboard.php");
                exit;
            } else {
                echo $error;
            }
        }else {
            echo $error;
        }
    }

    public function getUser($user_id){
        $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }else{
            die("Error: ".$this->conn->error);
        }
    }

    public function updateImage($user_id,$image_name,$image_tmp){
        $sql = "UPDATE users SET `image` = '$image_name'  WHERE `user_id` = '$user_id'  ";

        // exucute
        if ($this->conn->query($sql)) {

            // bring photo into ..img/
            $destination = "../img/" . basename($image_name);
            if(move_uploaded_file($image_tmp,$destination)){
                $_SESSION['image_name'] = $image_name;
                header("location: ../views/update.php?user_id=".$user_id);
                exit;
            }else{
                die("Error uploading image ".$this->conn->error);
            }
        }else{
            die("Error uploading image: ".$this->conn->error);
        }
    }

    public function updateUser($user_id,$username,$email,$introduction,$password){
        $introduction = $this->conn->real_escape_string($introduction);
        $sql = "UPDATE users SET username = '$username' , email = '$email' ,  `introduction` = '$introduction' , `password` = '$password' WHERE `user_id` = '$user_id'  ";

        if($this->conn->query($sql)){
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['introduction'] = $introduction;
            $_SESSION['password'] = $password;
            header("location: ../views/update.php?user_id=".$user_id);
            exit;
        }else{
            die("Error updating user: ".$this->conn->error);
        }

    }

    public function setOneCandidate($user_id,$gender){

        // It doesn't set a user(candidate) that already liked by login user

        // STEP1 : get all Females or Males
        $sql1 = "SELECT * FROM `users` WHERE `status` =  'A' AND `gender` != '$gender' ";
        $result1 = $this->conn->query($sql1);
        $candidates1 = array();
        while ($value = $result1->fetch_assoc()) {
            $candidates1[] = $value;
        }
        $cnt1 = count($candidates1);

        // STEP2 : get candidates that already liked/skiped by login user
        $sql2 = "SELECT * FROM likes_skips WHERE user_id = '$user_id' AND ( ls_status = 'like' OR ls_status = 'skip')";
        $result2 = $this->conn->query($sql2);
        $candidates2 = array();
        while ($value = $result2->fetch_assoc()) {
            $candidates2[] = $value;
        }
        $cnt2 = count($candidates2);

        // in a case of "NO CANDIDATE" , set null in candidate
        if($cnt1 == $cnt2){
            $this->candidate =  [];
        }else{

        do{
            // STEP3 : choose one candidate
            $number = array_rand($candidates1);

            // STEP4 : check to see if the candidate already liked/skiped -> TRUE
            $candidate1_user_id = $candidates1[$number]['user_id'];
        } while (in_array( $candidate1_user_id, array_column($candidates2, 'ls_user_id')));
        
        // -- FALSE --
        // STEP5 : add data into array
        $this->candidate['user_id'] = $candidates1[$number]['user_id'] ;
        $this->candidate['username'] = $candidates1[$number]['username'] ;
        $this->candidate['gender'] = $candidates1[$number]['gender'] ;
        $this->candidate['date_of_birth'] = $candidates1[$number]['date_of_birth'] ;
        $this->candidate['image'] = $candidates1[$number]['image'] ;
        $this->candidate['introduction'] = $candidates1[$number]['introduction'] ;
        $this->candidate['status'] = $candidates1[$number]['status'] ;

    }
    }

    public function getOneCandidate(){       
        // header("location: ../views/dashboard.php");
        return $this->candidate ;
    }

    public function registerLike($user_id,$ls_user_id,$gender){
        $now = date('Y/m/d H:i:s');

        // SEARCH
        $search = "SELECT `ls_id` FROM `likes_skips` WHERE `user_id` = '$user_id' AND `ls_user_id` = '$ls_user_id' ";
        $return = $this->conn->query($search);

        if ($return->num_rows == 1) {

            // UPDATE
            $row = $return->fetch_assoc();
            $ls_id = $row['ls_id'];
            $sql2 = "UPDATE `likes_skips` SET `ls_status` = 'like',`date` = '$now' WHERE `ls_id` = '$ls_id' ";
            $this->conn->query($sql2);

            // register MATCH

        //INSERT
        }elseif ($return->num_rows == 0) {   
            $sql2 = "INSERT likes_skips (ls_status,`user_id`,ls_user_id,`date`)  VALUE ('like','$user_id','$ls_user_id','$now' ) ";

            if ($this->conn->query($sql2)) {
                return;
            }else{
                die("Error registering LIKE: ".$this->conn->error);    
            }  
        }else{
            die("Error registering (more than 2 rows are existing?): ". $this->conn->error);  
        }

    }

        // ---- REGISTER MATCH ----
        public function registerMatch($user_id,$ls_user_id,$gender){
            $now = date('Y/m/d H:i:s');
        // search through 'likes_skips' table
        $sql3 = "SELECT * FROM `likes_skips` WHERE `user_id` = '$ls_user_id' AND `ls_user_id` = '$user_id' AND `ls_status` = 'like' AND `status` = 'A' " ;
        $result3 = $this->conn->query($sql3);

        // variables set
        if ($gender == 'male') {
            $male_user_id = $user_id;
            $female_user_id = $ls_user_id;
        }elseif ($gender == 'female') {
            $male_user_id = $ls_user_id;
            $female_user_id = $user_id;
        }

        // not matched yet -> insert
        if ($result3->num_rows == 1) {
            $sql4 = "INSERT matches (`male_user_id`,`female_user_id`,`date`) VALUE ('$male_user_id','$female_user_id','$now') " ;
            if ($this->conn->query($sql4)) {
                return "success";
            }else{
                die("Error registering1 MATCH: ".$this->conn->error);    
            }
        }

    }

    public function registerSkip($user_id,$ls_user_id){
        $now = date('Y/m/d H:i:s');

        // SEARCH
        $search = "SELECT `ls_id` FROM `likes_skips` WHERE `user_id` = '$user_id' AND `ls_user_id` = '$ls_user_id' AND `ls_status` = 'skip' ";
        $return = $this->conn->query($search);

        if ($return->num_rows == 1) {

            // UPDATE (NO NEED?)
            $row = $return->fetch_assoc();
            $ls_id = $row['ls_id'];
            $sql2 = "UPDATE `likes_skips` SET `ls_status`='skip',`date`= '$now' WHERE `ls_id` = '$ls_id' ";
            $this->conn->query($sql2);

        //INSERT
        }elseif ($return->num_rows == 0) {   
            $sql2 = "INSERT likes_skips (ls_status,`user_id`,ls_user_id,`date`)  VALUE ('skip','$user_id','$ls_user_id','$now' ) ";

            if ($this->conn->query($sql2)) {
                return;
            }else{
                die("Error registering SKIP: ".$this->conn->error);    
            }  
        }else{
            die("Error registering (more than 2 rows are existing?): ".$this->conn->error);  
        }
    }


    public function setMatchList($user_id,$gender){

        if ($gender == 'male') {
            $sql = "SELECT * FROM matches INNER JOIN users ON matches.female_user_id = users.user_id WHERE male_user_id = '$user_id' AND matches.status = 'A' ORDER BY match_id DESC ";
        }else{
            $sql = "SELECT * FROM matches INNER JOIN users ON matches.male_user_id = users.user_id WHERE female_user_id = '$user_id' AND matches.status = 'A' ORDER BY match_id DESC ";
        }
        
        $result = $this->conn->query($sql);
        $this->match_list = $result;

    }

    public function getMatchList(){
        return $this->match_list ;
    }

    public function setMatchedUser($gender,$match_id){
        if ($gender == 'male') {
            $sql = "SELECT * FROM matches INNER JOIN users ON matches.female_user_id = users.user_id WHERE match_id = '$match_id' AND  matches.status = 'A' ";
        }else{
            $sql = "SELECT * FROM matches INNER JOIN users ON matches.male_user_id = users.user_id WHERE match_id = '$match_id' AND matches.status = 'A' ";
        }
        
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $this->matched_user = $row;
    }

    public function getMatchedUser(){
        return $this->matched_user ;
    }

    public function setMessages($match_id){
        $sql = "SELECT * FROM chats WHERE match_id = '$match_id' AND `status` = 'A' ORDER BY chat_id DESC";
        $result = $this->conn->query($sql);
        $this->messages = $result;
    }

    public function getMessages(){
        return $this->messages ;
    }

    public function postMessage($match_id,$user_id,$message,$now){
        $message = $this->conn->real_escape_string($message);
        $sql = "INSERT INTO chats (`match_id`,`user_id`,`message`,`date`) VALUES ('$match_id','$user_id','$message','$now') ";
        if ($this->conn->query($sql)) {
            header("location: ../views/chat.php?match_id=".$match_id);
                exit;
            }else{
                die("Error post message ".$this->conn->error);
            }
    }

    

}



        // [NOTE] 

/*
    public function registerSkip($user_id,$ls_user_id){
        $now = date('Y/m/d H:i:s');
        $sql = "INSERT likes_skips (ls_status,`user_id`,ls_user_id,`date`) VALUE ('skip','$user_id','$ls_user_id','$now' ) ";

        if ($this->conn->query($sql)) {
            return;
        }else{
            die("Error registering SKIP: ".$this->conn->error);    
        }  

    }

    */


        // if ($result = $this->conn->query($sql)) {
        //     return $result->fetch_all($resulttype = MYSQLI_ASSOC);
        // }
/*
        if($result1->num_rows > 0){
            while ($value = $result1->fetch_assoc()) {
                $candidates[] = $value;
            }
                // choose one candidate
                $number = array_rand($candidates);

                // check
                $tmp_ls_user_id = $candidates[$number]['user_id'] ;

                if(in_array( $tmp_ls_user_id, array_column($array2, 'ls_user_id'))){
                    echo 'appleとう値を持つデータは存在する';
                }else{
                    echo 'appleとう値を持つデータは存在しない';
                }

                // add data into array
                $this->candidate['user_id'] = $candidates[$number]['user_id'] ;
                $this->candidate['username'] = $candidates[$number]['username'] ;
                $this->candidate['gender'] = $candidates[$number]['gender'] ;
                $this->candidate['date_of_birth'] = $candidates[$number]['date_of_birth'] ;
                $this->candidate['image'] = $candidates[$number]['image'] ;
                $this->candidate['introduction'] = $candidates[$number]['introduction'] ;
                $this->candidate['status'] = $candidates[$number]['status'] ;
        }else{
            return false;
        }
*/