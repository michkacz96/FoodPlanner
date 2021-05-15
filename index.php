<?php
include_once 'config/init.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == True){
    /*$user = new User;

    //template
    $template = new Template('templates/frontpage.php');
    $template->user = $user->getSingleUser($_SESSION['user_id']);;

    //page title
    $template->title = 'Food Planner';

    echo $template;*/
    header('Location: dashboard.php');
}else{
    //template
    $template = new Template('templates/frontpage.php');

    //page title
    $template->title = 'Food Planner';

    echo $template;
}

