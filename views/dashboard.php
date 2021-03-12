<?php 
    session_start();
    if (!$_SESSION['id']) { //if no session id
        header("location: login.php");
    }
    require_once "../classes/user.php";
    
    $user = new User;
    $user_id = $_SESSION['id'];
    $gender = $_SESSION['gender'];
    
    $user->setOneCandidate($user_id,$gender);
    $candidate = $user->getOneCandidate();

    $candidate = "";
    if(isset($_POST['like'])){
        $ls_user_id = $_POST['ls_user_id'];
        $user->registerLike($user_id,$ls_user_id);
        $user->setOneCandidate($user_id,$gender);
        $candidate = $user->getOneCandidate();
    }

    if (isset($_POST['skip'])) {
        $user->registerSkip($user_id,$ls_user_id);
        $user->setOneCandidate($user_id,$gender);
        $candidate = $user->getOneCandidate();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
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
<body>

<?php include "header.php" ;?>

<div class="container w-75 mt-5">
    <div class="col-md-12">
        <img src="../img/<?= $candidate['image']?>" class="img-fluid">
        <div class="row">
            <p class="display-4 col-md-8">
                <?= $candidate['username']?>
                <?= $candidate['date_of_birth']?>
            </p>
        </div>
        <p class="display-5"><?= $candidate['introduction']?></p>
    </div>

    <form action="" method="post">
        <div class="form-row">
            <!-- HIDDEN -->
            <input type="hidden" name="ls_user_id" value="<?= $candidate['user_id']?>">
        <input type="submit" value="SKIP" name="skip" class="btn btn-secondary col-sm-6">
        <input type="submit" value="LIKE" name="like" class="btn btn-warning col-sm-6">
        
        </div>
    </form>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>