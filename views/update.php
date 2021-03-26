<?php 
    session_start();
    if ($_SESSION['id'] != $_GET['user_id']) { //if no session id
        header("location: dashboard.php");
    }

    require_once "../actions/getUser.php";
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
<title>update</title>
</head>
<body>
<?php include "header.php" ;?>


    <!-- FORM ACTION & POPUP -->
    <?php
    if(isset($_POST['update_img'])) {
    if(password_verify($_POST['current_password1'],$_SESSION['password'])) {
    $user_id = $_POST['user_id'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $user = new User;
    $user->updateImage($user_id,$image_name,$image_tmp);
    }else{ ?>
        <div class="alert alert-danger text-center display-5" role="alert">
        wrong password
        </div> 
    <?php 
    }}
    ?>

    <?php
    if(isset($_POST['update_user'])) {
    if(password_verify($_POST['current_password2'],$_SESSION['password'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $introduction = $_POST['introduction'];

    if (empty($_POST['new_password'])) {
        $password = password_hash($_POST['current_password2'],PASSWORD_DEFAULT);
    }else{
        $password = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
    }

    $user = new User;
    $user->updateUser($user_id,$username,$email,$introduction,$password);
    }else{ ?>
        <div class="alert alert-danger text-center display-5" role="alert">
        wrong password
        </div> 
    <?php 
    }}
    ?>



<div class="container w-50 mt-5">
    <h1 class="display-4 text-center">CURRENT YOUR PROFILE</h1>

        <!-- UPDATE IMG -->
        <form action="" method="post" class="my-5" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <img src="../img/<?= $user_details['image'] ?>" class="img-fluid">
                </div>
                <div class="form-group col-md-12">
                    <input type="file" class="form-control-file" id="image" name="image" value="<?= $user_details['image'] ?>" required>
                </div>
            </div>
            
            <!-- HIDDEN -->
            <input type="hidden" name="user_id" value="<?= $user_details['user_id']?>">

            <!-- CONFIRM CURRENT PASSWORD & SUBMIT -->

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#imageModal">
            update your photo
            </button>

            <!-- Modal -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>CURRENT PASSWORD</p>
                    <input type="password" name="current_password1" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <div class="form-group">
                        <input type="submit" value="submit" name="update_img" class="form-control btn btn-warning">
                    </div>
                </div>
                </div>
            </div>
            </form>
            </div>

        <!-- UPDATE INFO -->
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="username" class="form-control" value="<?= $user_details['username'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control" value="<?= $user_details['email'] ?>"  required>
                </div>
            </div>
            <!-- <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="date_of_birth">date of birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="<?= $user_details['date_of_birth'] ?>"  required>
                </div>
            </div> -->
            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea name="introduction" cols="30" rows="10" class="form-control" ><?= $user_details['introduction'] ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="new_password">New password (if you need)</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" >
                </div>
            </div>

            <!-- HIDDEN -->
            <input type="hidden" name="user_id" value="<?= $user_details['user_id']?>">
            <input type="hidden" name="old_password"  value="<?= $user_details['password'] ?>">

            <!-- CONFIRM CURRENT PASSWORD & SUBMIT -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#infoModal">
            update your info
            </button>

            <!-- Modal -->
            <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>CURRENT PASSWORD</p>
                    <input type="password" name="current_password2" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <div class="form-group">
                        <input type="submit" value="submit" name="update_user" class="form-control btn btn-warning">
                    </div>
                </div>
                </div>
            </div>
            </form>
            </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>