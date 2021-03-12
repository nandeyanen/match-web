<?php

require_once "../classes/user.php";

$user_id = $_POST['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$date_of_birth = $_POST['date_of_birth'];
$introduction = $_POST['introduction'];

if (!$_POST['new_password']) {
    $password = password_hash($_POST['old_password'],PASSWORD_DEFAULT); 
}else{
    $password = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
}


$user = new User;
$user->updateUser($user_id,$username,$email,$date_of_birth,$introduction,$password);