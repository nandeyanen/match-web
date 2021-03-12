<?php 
    session_start();
    if (!$_SESSION['id']) { //if no session id
        header("location: login.php");
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

<div class="container w-50 mt-5">
    <h1 class="display-4 text-center">YOUR PROFILE</h1>

        <!-- UPDATE IMG -->
        <form action="../actions/updateImage.php" method="post" class="my-5" enctype="multipart/form-data">
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

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="submit" value="update your photo" name="update_img" class="form-control btn btn-warning">
                </div>
            </div>
        </form>

        <!-- UPDATE INFO -->
        <form action="../actions/updateUser.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="username" class="form-control" value="<?= $user_details['username'] ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control" value="<?= $user_details['email'] ?>"  required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="date_of_birth">date of birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="<?= $user_details['date_of_birth'] ?>"  required>
                </div>
            </div>
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

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="submit" value="update your info" name="updateUser" class="form-control btn btn-success">
                </div>
            </div>
        </form>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>