<?php
include_once 'config/init.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == True){
    $user = new User;

    //template
    $template = new Template('templates/single-user.php');
    $template->user = $user->getSingleUser($_SESSION['user_id']);
    $template->userWeight = $user->getWeight($_SESSION['user_id']);

    //add weight
    if(isset($_POST['addWeightBtn'])){
        $weight = $_POST['addWeight'];

        if(empty($weight)){
            header('Location: user-info.php?weightError=noweight');
        }else{
            if($user->addWeight($weight, $_SESSION['user_id'])){
                header('Location: user-info.php?weightError=success');
            }else{
                header('Location: user-info.php?weightError=updateError');
            }
        }
    }

    if(isset($_POST['updateUserInfo'])){
        $data = array();

        $data['updateEmail'] = $_POST['updateEmail'];
        $data['updateGender'] = $_POST['updateGender'];
        $data['updateBirth'] = $_POST['updateBirth'];
        $data['updateHeight'] = $_POST['updateHeight'];

        if(empty($data['updateEmail']) || empty($data['updateGender']) || empty($data['updateBirth']) || empty($data['updateHeight'])){
            header('Location: user-info.php?infoError=nodata');
        }else{
            if($user->updateInfo($data, $_SESSION['user_id'])){
                header('Location: user-info.php?infoError=success');
            }else{
                header('Location: user-info.php?infoError=updateError');
            }
        }
    }

    if(isset($_GET['delete'])){
        $weightID = $_GET['delete'];

        if($user->deleteWeight($weightID)){
            header('Location: user-info.php?weightError=successDelete');
        } else{
            header('Location: user-info.php?weightError=updateError');
        }
    }

    //page title
    $template->title = 'FoodPlanner | '.$_SESSION['username'];

    echo $template;
}else{
    header('Location: index.php');
}
