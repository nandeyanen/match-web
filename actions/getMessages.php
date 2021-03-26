<?php

    include "../classes/user.php";

    $user = new User;
    $match_id = $_GET['match_id'];
    $user->setMessages($match_id);
    $messages = $user->getMessages();
