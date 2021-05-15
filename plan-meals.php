<?php
include_once 'config/init.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == True){
    $user = new User;

    //template
    $template = new Template('templates/plan-meals.php');
    $template->user = $user->getSingleUser($_SESSION['user_id']);
    
    $meal = new Food;
    $template->mealplans = $meal->getUserMealPlans($_SESSION['user_id']);
    $template->mselected = $user->getPlan($_SESSION['user_id']);
    if($user->getPlan($_SESSION['user_id']) > 0){
        $template->showplan = $meal->getMealPlan($user->getPlan($_SESSION['user_id']));
    }



    if(isset($_POST['mpBtn'])){
        if($_POST['mpBtn'] == 'selectMP'){
            $plan = $_POST['selectMealPlan'];
            $template->showplan = $meal->getMealPlan($plan);

        } elseif($_POST['mpBtn'] == 'useMP'){
            $meal->changePlan($_POST['selectMealPlan'], $_SESSION['user_id']);
        }
    }

    

    //page title
    $template->title = 'FoodPlanner | '.$_SESSION['username'];

    echo $template;
}else{
    header('Location: index.php');
}
