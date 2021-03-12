<?php

require_once "../classes/user.php";

$gender = $_POST['gender'];
$username = $_POST['username'];
$email = $_POST['email'];
$date_of_birth = $_POST['date_of_birth'];
$image_name = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];
$introduction = $_POST['introduction'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT); 


$user = new User;
$user->createUser($gender,$username,$email,$date_of_birth,$image_name,$image_tmp,$introduction,$password);