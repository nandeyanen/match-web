<?php

require_once "../classes/user.php";

$user_id = $_POST['user_id'];
$image_name = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];

$user = new User;
$user->updateImage($user_id,$image_name,$image_tmp);