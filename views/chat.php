<?php 
    session_start();

    require_once "../actions/getMessages.php";

    function setAge($birth){
        $now = date('Y-m-d');
        $start_date = strtotime($now);
        $end_date = strtotime($birth);
        return floor(($start_date - $end_date)/60/60/24/365);
    }
    
    require_once "../classes/user.php";
    $user = new User;
    $user_id = $_SESSION['id'];
    $gender = $_SESSION['gender'];

    // display matchlist (right-sided colum)
    $user->setMatchList($user_id,$gender);
    $match_list = $user->getMatchList();


    // diplay matched_user
    $user->setMatchedUser($gender,$match_id);
    $matched_user = $user->getMatchedUser();

    // block direct access
    $gender_user_id = $_SESSION['gender']."_user_id";
    if ($matched_user[$gender_user_id] != $user_id) {
        header("location: dashboard.php");
    }

?>


<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>chat</title>
</head>
<body style="height:100%;">

<?php include "header.php" ;?>

<!-- 2colums  -->
<div class="container-fluid w-75 h-100 mt-5">
<div class="row h-100">

    <!-- left colum start-->
    <div class="col-md-7 mx-auto h-100">

    <!-- CHATROOM INFO -->
    <div class="text-center">
        <div class="">
            <p class="display-4">CHATROOM </p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="font-italic font-weight-bold ">with <?= $matched_user['username'] ?></p>
            </div>
        </div>
    </div>

    <!-- POST MESSAGE FORM -->
    <div class="col-md-12 mx-auto">
        <form action="../actions/postMessage.php" method="post">
            <input type="hidden" name="match_id" value='<?= $_GET['match_id']?>'>
            <input type="hidden" name="user_id" value='<?= $_SESSION['id']?>'>
            <div class="row">
            <textarea name="message" cols="" rows="1" class="form-control required col-md-8 mr-1"></textarea>
            <input type="submit" value="SEND" name="post" class="form-control btn btn-primary col-md-2">
            </div>
        </form>
    </div>

     <!-- DISPLAY MESSSAGES -->
    <div class="">
        <?php while($r = $messages->fetch_assoc()){
            
            if ($r['user_id'] == $user_id) { ?>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <img src="../img/<?= $_SESSION['image_name'] ?>"  class="img-thumbnail" >
                    </div>
                    <div class="col-md-10">
                        <p class="font-weight-bold d-md-inline">YOU </p>
                        <p class="font-italic d-md-inline"><?= $r['date'] ?></p>
                        <p><?= $r['message'] ?></p>
                    </div>
                </div>
            <?php }else{ ?>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <img src="../img/<?= $matched_user['image'] ?>"  class="img-thumbnail" >
                    </div>
                    <div class="col-md-10">
                        <p class="font-weight-bold d-md-inline"><?= $matched_user['username'] ?></p> 
                        <p class="font-italic d-md-inline"><?= $r['date'] ?></p>
                        <p><?= $r['message'] ?></p>
                    </div>
                </div>
        <?php } } ?>
    </div>

    </div>
    <!-- left-side colum ended -->

    <!-- right-side colum start -->
    <div class="col-md-5 h-100">

        <!-- match list -->
        <div class="bg-secondary mb-2 p-3">
            <h4 class="text-center text-warning">MATCH LIST</h4>

            <!-- if no match -->
            <?php if (!$match_list) { ?>
                <h3 class="text-center">You have no MATCH yet.</h3>
            <?php }else{ ?>
            
            <!-- match -->
            <?php while($r = $match_list->fetch_assoc()){ ?>
            <div class="card mb-3">
                <div class="row p-2">
                    <div class="col-md-6">
                        <img src="../img/<?= $r['image'] ?>" class="card-img img-fluid">
                    </div>
                    <div class="col-md-6">
                        <div class="card-header">
                            <h4 class="card-text"><?= $r['username'] ?></h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-text"><?= setAge($r['date_of_birth']) ?></h5>
                            <p class="card-text"><?= $r['introduction'] ?></p>
                            <a href="chat.php?match_id=<?= $r['match_id'] ?>"><button class="btn btn-outline-primary">CHAT</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } }?>
        </div>

        <!-- your profile -->
        <hr>
        <div class="card border-info mb-3">
            <div class="card-header text-center"><h4>your current profile</h4></div>
            <img class="card-img-top col-md-11 mt-2 mx-auto" src="../img/<?= $_SESSION['image_name'] ?>">
            <div class="card-body col-md-11 mx-auto">
                <h5 class="card-title"><?= $_SESSION['username'] ?>  / age:<?= $_SESSION['age'] ?></h5>
                <p class="card-text"><?= $_SESSION['introduction'] ?></p>
                <a href="update.php?user_id=<?=$_SESSION['id']?>" class="btn btn-info col-md-12">edit your profile</a>
            </div>
        </div>

        


    </div>
    <!-- right-side colum ended -->

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
