<?php 
    session_start();
    if (!$_SESSION['id']) { //if no session id
        header("location: ../actions/logout.php");
    }
    require_once "../classes/user.php";
    
    function setAge($birth){
        $now = date('Y-m-d');
        $start_date = strtotime($now);
        $end_date = strtotime($birth);
        return floor(($start_date - $end_date)/60/60/24/365);
    }

    $user = new User;
    $user_id = $_SESSION['id'];
    $gender = $_SESSION['gender'];
    

    $candidate = "";
    $match = "" ;
    $matchlist = array();


    if(!$_POST){
        $user->setOneCandidate($user_id,$gender);
        $candidate = $user->getOneCandidate();
    }


    if(isset($_POST['like'])){
        $ls_user_id = $_POST['ls_user_id'];
        $user->registerLike($user_id,$ls_user_id,$gender);
        $match = $user->registerMatch($user_id,$ls_user_id,$gender);
        $user->setOneCandidate($user_id,$gender);
        $candidate = $user->getOneCandidate();
    }

    if (isset($_POST['skip'])) {
        $ls_user_id = $_POST['ls_user_id'];
        $user->registerSkip($user_id,$ls_user_id);
        $user->setOneCandidate($user_id,$gender);
        $candidate = $user->getOneCandidate();
    }

    // display matchlist
    $user->setMatchList($user_id,$gender);
    $match_list = $user->getMatchList();

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
<title>dashboard</title>
</head>
<body style="height:100%;">

<?php include "header.php" ;?>

<!-- 2colums  -->
<div class="container-fluid w-75 h-100 my-5">
<div class="row h-100 my-5">

    <!-- left colum start-->
    <div class="col-md-7 h-100 ">

        <!-- MODAL WINDOW to notice matching -->
        <?php if ($match == "success") { ?>
            <div class="mt-5">
                <div class="alert alert-success text-center display-4" role="alert">
                You got a MATCH!
                </div> 
            </div>
        <?php } ?>

        <!-- --AFTER STARTED-- -->

        <!-- no users(candidates) -->
        <?php if (!$candidate) { ?>
            <div class="mx-auto">
                <p class="display-2">no more users</p>
                <p class="display-4">Sorry, please RESTART after a while.</p>
            </div>
                <?php } else { ?>

            <!-- display a user (candidate) -->
            <!-- buttons -->
            <div class="row mb-5">

                <!-- REGISTER SKIP BUTTON -->
                <form action="" method="post" class="col-sm-6">
                    <!-- HIDDEN -->
                    <input type="hidden" name="ls_user_id" value="<?= $candidate['user_id']?>">
                    <input type="submit" value="SKIP" name="skip" class="btn btn-secondary col-sm-12">
                </form>

                <!-- REGISTER LIKE BUTTON -->
                <form action="" method="post" class="col-sm-6">
                    <!-- HIDDEN -->
                    <input type="hidden" name="ls_user_id" value="<?= $candidate['user_id']?>">
                    <input type="submit" value="LIKE" name="like" class="btn btn-warning col-sm-12">
                </form>
            </div>

            <!-- profile -->
            <div class="h-100">
                <div class="col-md-12 h-100">

                    <img src="../img/<?= $candidate['image']?>" class="h-50 img-fluid">
                    <div class="row">
                        <p class="display-4 col-md-8">
                            <?= $candidate['username']?>
                              (age:<?= setAge($candidate['date_of_birth']) ?>)
                        </p>
                    </div>
                    <p class="display-5"><?= $candidate['introduction']?></p>
                </div>
            </div>
            <?php } ?>

            
    </div>
    <!-- left-side colum ended -->

    <!-- right-side colum start -->
    <div class="col-md-5 h-100">

        <!-- match list -->
        <div class="bg-secondary mb-2 p-3">
            <h4 class="text-center text-warning">MATCH LIST</h4>
           
            <!-- if no match -->
            <?php if (!$match_list) { ?>
                <p class="text-center text-light">You have no MATCH yet.</p>
            <?php }else{ ?>
        
            <!-- match -->
            <?php while($match_item = $match_list->fetch_assoc()){ ?>
            <div class="card mb-3">
                <div class="row p-2">
                    <div class="col-md-6">
                        <img src="../img/<?= $match_item['image'] ?>" class="card-img img-fluid">
                    </div>
                    <div class="col-md-6">
                        <div class="card-header">
                            <h4 class="card-text"><?= $match_item['username'] ?></h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-text"> age:<?= setAge($match_item['date_of_birth']) ?></h5>
                            <p class="card-text"><?= $match_item['introduction'] ?></p>
                            <a href="chat.php?match_id=<?= $match_item['match_id'] ?>"><button class="btn btn-outline-primary">CHAT</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } }?>
        </div>

        <!-- your profile -->
        <hr>
        <div class="card border-info mb-5">
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
</div>

<!-- <footer class="bg-dark text-center mt-5 w-100 h-10">
    <p class="text-light">AWESOME MATCH</p>
</footer> -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
