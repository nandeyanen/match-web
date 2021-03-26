<?php

require_once "../classes/user.php";

$match_id = $_POST['match_id'];
$user_id = $_POST['user_id'];
$message = $_POST['message'];
$now = date('Y/m/d H:i:s');

$user = new User;
$user->postMessage($match_id,$user_id,$message,$now);