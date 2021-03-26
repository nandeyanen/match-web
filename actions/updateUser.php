<?php

require_once "../classes/user.php";

if (password_verify($_SESSION['password'],$_POST['current_password'])) {
$user_id = $_POST['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$introduction = $_POST['introduction'];

if (isset($_POST['new_password'])) {
    $password = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
}else{
    $password = password_hash($_POST['current_password'],PASSWORD_DEFAULT);
}


$user = new User;
$user->updateUser($user_id,$username,$email,$introduction,$password);

}