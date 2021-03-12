<?php

    include "../classes/user.php";

    $user = new User;
    $user_id = $_GET['user_id'];
    $user_details = $user->getUser($user_id);
