<?php

//start the session
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] <= 0) {
    exit('You are not allowed');
}
?>
