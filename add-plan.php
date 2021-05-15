<?php
include_once 'config/init.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == True){
    $user = new User;

    //template
    $template = new Template('templates/add-plan.php');
    $template->user = $user->getSingleUser($_SESSION['user_id']);;

    if(isset($_POST['searchBtn'])){
        if(empty($_POST['searchQuery'])){
            header('location: add-plan.php?error=emptyquery');
        }
        $food = getFood($_POST['searchQuery']);
        $template->foodItem = $food;
    }

    if(isset($_POST['addPlan'])){
        if(empty($_POST['planName'])){
            header('location: add-plan.php?error=emptyquery');
        }

        $meal = new Food;

        if($meal->addPlan($_SESSION['user_id'], $_POST['planName'])){
            header('location: add-plan.php?error=success');
        } else{
            header('location: add-plan.php?error=nosuccess');
        }
    }

    if(isset($_POST['add'])){
        $item = $_POST['item'];

        $day = intval($_POST['weekDay']);
        $itemName = $_POST[$item]['name'];
        $itemMass = 100;
        $itemProt = $_POST[$item]['protein'];
        $itemFat = $_POST[$item]['fat'];
        $itemCarbs = $_POST[$item]['carbs'];
        $itemKcal = $_POST[$item]['kcal'];

        if(isset($_SESSION['mealItems'][$day])){
            $i = count($_SESSION['mealItems'][$day]);

            $_SESSION['mealItems'][$day][$i]['name'] = $itemName;
            $_SESSION['mealItems'][$day][$i]['mass'] = $itemMass;
            $_SESSION['mealItems'][$day][$i]['prot'] = $itemProt;
            $_SESSION['mealItems'][$day][$i]['fat'] = $itemFat;
            $_SESSION['mealItems'][$day][$i]['carbs'] = $itemCarbs;
            $_SESSION['mealItems'][$day][$i]['kcal'] = $itemKcal;

            $_SESSION['mealItems100'][$day][$i]['name'] = $itemName;
            $_SESSION['mealItems100'][$day][$i]['mass'] = $itemMass;
            $_SESSION['mealItems100'][$day][$i]['prot'] = $itemProt;
            $_SESSION['mealItems100'][$day][$i]['fat'] = $itemFat;
            $_SESSION['mealItems100'][$day][$i]['carbs'] = $itemCarbs;
            $_SESSION['mealItems100'][$day][$i]['kcal'] = $itemKcal;

            
        } else{
            $_SESSION['mealItems'][$day] = array();
            $_SESSION['mealItems'][$day][0]['name'] = $itemName;
            $_SESSION['mealItems'][$day][0]['mass'] = $itemMass;
            $_SESSION['mealItems'][$day][0]['prot'] = $itemProt;
            $_SESSION['mealItems'][$day][0]['fat'] = $itemFat;
            $_SESSION['mealItems'][$day][0]['carbs'] = $itemCarbs;
            $_SESSION['mealItems'][$day][0]['kcal'] = $itemKcal;

            $_SESSION['mealItems100'][$day] = array();
            $_SESSION['mealItems100'][$day][0]['name'] = $itemName;
            $_SESSION['mealItems100'][$day][0]['mass'] = $itemMass;
            $_SESSION['mealItems100'][$day][0]['prot'] = $itemProt;
            $_SESSION['mealItems100'][$day][0]['fat'] = $itemFat;
            $_SESSION['mealItems100'][$day][0]['carbs'] = $itemCarbs;
            $_SESSION['mealItems100'][$day][0]['kcal'] = $itemKcal;
        }
    }

    if(isset($_POST['updateValue'])){
        $day = $_POST['dayName'];
        $item = $_POST['updateValue'][$day];
        $mass = $_POST['updateMass'][$day][$item];

        if($mass == 0){
            $_SESSION['mealItemsTmp'][$day] = $_SESSION['mealItems'][$day];
            unset($_SESSION['mealItems'][$day]);
            unset($_SESSION['mealItemsTmp'][$day][$item]);

            $_SESSION['mealItemsTmp100'][$day] = $_SESSION['mealItems100'][$day];
            unset($_SESSION['mealItems100'][$day]);
            unset($_SESSION['mealItemsTmp100'][$day][$item]);

            $_SESSION['mealItems'][$day] = array_values($_SESSION['mealItemsTmp'][$day]);
        } else{
            $_SESSION['mealItems'][$day][$item]['mass'] = $mass;
            $_SESSION['mealItems'][$day][$item]['prot'] = round((($_SESSION['mealItems100'][$day][$item]['prot'] * $mass) / 100),2);
            $_SESSION['mealItems'][$day][$item]['fat'] = round((($_SESSION['mealItems100'][$day][$item]['fat'] * $mass) / 100), 2);
            $_SESSION['mealItems'][$day][$item]['carbs'] = round((($_SESSION['mealItems100'][$day][$item]['carbs'] * $mass) / 100), 2);
            $_SESSION['mealItems'][$day][$item]['kcal'] = round((($_SESSION['mealItems100'][$day][$item]['kcal'] * $mass) / 100), 2);
        }
    }

    


    //page title
    $template->title = 'FoodPlanner | '.$_SESSION['username'];

    echo $template;
}else{
    header('Location: index.php');
}

