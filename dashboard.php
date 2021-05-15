<?php
include_once 'config/init.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == True){
    $user = new User;
    //template
    $template = new Template('templates/dashboard.php');
    $template->user = $user->getSingleUser($_SESSION['user_id']);
    $template->height = $user->getHeight($_SESSION['user_id'])->userHeight;
    if($user->getLastWeight($_SESSION['user_id'])){
        $template->weight = $user->getLastWeight($_SESSION['user_id'])->weight;
    } else{
        $template->weight = 0;
    }
    $template->bmi = $user->getBMI($_SESSION['user_id']);
    $template->bmiName = $user->getBmiName($template->bmi);
    $template->bmr = $user->getBMR($_SESSION['user_id']);

    //page title
    $template->title = 'FoodPlanner | '.$_SESSION['username'];

    echo $template;
}else{
    header('Location: index.php');
}

