<?php
include_once 'config/init.php';

unset($_SESSION['loggedin']);
unset($_SESSION['user_id']);
unset($_SESSION['user_email']);

session_destroy();
header('Location: index.php');