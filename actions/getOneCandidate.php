<?php
session_start();
include "../classes/user.php";

$user = new User;
$user_id = $_SESSION['id'];
$gender = $_SESSION['gender'];
$user->setOneCandidate($user_id,$gender);
$candidate = $user->getOneCandidate();
header("location: ../views/dashboard.php");

// print_r($candidate);
// print_r($user->getOneCandidate());
// print_r($user->candidate);
