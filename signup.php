<?php
include_once 'config/init.php';
//user
$user = new User;

if(isset($_POST['signup'])){
    $data = array();
    $data['username'] = $_POST['uid'];
    $data['email'] = $_POST['email'];
    $data['pwd1'] = $_POST['pwd1'];
    $data['pwd2'] = $_POST['pwd2'];

    if($user->createUser($data)){
        header('Location: signin.php');
    } else{
        header('Location: signup.php');
    }
}

//template
$template = new Template('templates/signup.php');

//page title
$template->title = 'Welcome';

echo $template;