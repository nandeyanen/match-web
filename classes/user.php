<?php
require_once "database.php";

class User extends Database{

    private $candidate = array() ; // for getOneCandidate

    public function createUser($gender,$username,$email,$date_of_birth,$image_name,$image_tmp,$introduction,$password){
        // sql
        $sql = "INSERT INTO users (username, email, gender, date_of_birth,`image`, introduction, `password`)  VALUES ('$username','$email','$gender','$date_of_birth','$image_name','$introduction','$password')";

        // WHAT IF A IMAGE FILE THAT HAS SAME NAME IS UPLOADED?

        // exucute
        if ($this->conn->query($sql)) {

            // bring photo into ..img/
            $destination = "../img/" . basename($image_name);
            if(move_uploaded_file($image_tmp,$destination)){
                header("location: ../views/dashboard.php");
                exit;
            }else{
                die("Error uploading image ".$this->conn->error);
            }
        }else{
            die("Error creating user: ".$this->conn->error);
        }
    }

    public function login($username,$password){
        // sql
        $error = "The username or password you entered is incorrect";
        $sql = "SELECT * FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $user_details = $result->fetch_assoc();
            if (password_verify($password,$user_details['password'])) {
                session_start();

                $_SESSION['id'] = $user_details['user_id'];
                $_SESSION['username'] = $user_details['username'];
                $_SESSION['image_name'] = $user_details['image'];
                $_SESSION['gender'] = $user_details['gender'];

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

    public function updateUser($user_id,$username,$email,$date_of_birth,$introduction,$password){
        $sql = "UPDATE users SET username = '$username' , email = '$email' , date_of_birth = '$date_of_birth' , introduction = '$introduction' , password = '$password' WHERE `user_id` = '$user_id'  ";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error updating user: ".$this->conn->error);
        }

    }

    public function updateImage($user_id,$image_name,$image_tmp){
        $sql = "UPDATE users SET `image` = '$image_name'  WHERE `user_id` = '$user_id'  ";

        // exucute
        if ($this->conn->query($sql)) {

            // bring photo into ..img/
            $destination = "../img/" . basename($image_name);
            if(move_uploaded_file($image_tmp,$destination)){
                header("location: ../views/dashboard.php");
                exit;
            }else{
                die("Error uploading image ".$this->conn->error);
            }
        }else{
            die("Error creating user: ".$this->conn->error);
        }
    }

    public function setOneCandidate($user_id,$gender){

        // get Female or Male
        if ($gender == 'female') {
            $sql = "SELECT `user_id`, `username`, `gender`, `date_of_birth`, `image`, `introduction`, `status` FROM `users` WHERE `status` =  'A' AND `gender` = 'male' ";
        }elseif ($gender == 'male') {
            $sql = "SELECT `user_id`, `username`, `gender`, `date_of_birth`, `image`, `introduction`, `status` FROM `users` WHERE `status` =  'A' AND `gender` = 'female' ";
        }

        $result = $this->conn->query($sql);
        $candidates = array();
        
        if($result->num_rows > 0){
            while ($value = $result->fetch_assoc()) {
                $candidates[] = $value;
            }
                // choose one candidate
                $number = array_rand($candidates);

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

    }

    public function getOneCandidate(){       
        // header("location: ../views/dashboard.php");
        return $this->candidate ;
    }

    public function registerLike($user_id,$ls_user_id){
        $now = date('Y/m/d H:i:s');

        // SEARCH
        $search = "SELECT `ls_id` FROM `likes_skips` WHERE `user_id` = '$user_id' AND `ls_user_id` = '$ls_user_id' ";
        $return = $this->conn->query($search);

        if ($return->num_rows == 1) {

            // UPDATE
            $row = $return->fetch_assoc();
            $ls_id = $row['ls_id'];
            $sql2 = "UPDATE `likes_skips` SET `ls_status`='like',`date`= '$now' WHERE `ls_id` = '$ls_id' ";

        //INSERT
        }elseif ($return->num_rows == 0) {   
            $sql2 = "INSERT likes_skips (ls_status,`user_id`,ls_user_id,`date`)
                VALUE ('like','$user_id','$ls_user_id','$now' ) ";

            if ($this->conn->query($sql2)) {
                return;
            }else{
                die("Error registering LIKE: ".$this->conn->error);    
            }  
        }else{
            die("Error registering (more than 2 rows are existing?): ".$this->conn->error);  
        }
    }

    public function registerSkip($user_id,$ls_user_id){
        $now = date('Y/m/d H:i:s');
        $sql = "INSERT likes_skips (ls_status,`user_id`,ls_user_id,`date`)
                VALUE ('skip','$user_id','$ls_user_id','$now' ) ";

        if ($this->conn->query($sql)) {
            return;
        }else{
            die("Error registering SKIP: ".$this->conn->error);    
        }  

    }

}



        // [NOTE] 
        // if ($result = $this->conn->query($sql)) {
        //     return $result->fetch_all($resulttype = MYSQLI_ASSOC);
        // }