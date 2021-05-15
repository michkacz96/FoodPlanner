<?php
include_once 'config/init.php';
$user = new User;

if(isset($_POST['signin'])){
    $data = array();
    $data['username'] = $_POST['uid'];
    $data['pwd'] = $_POST['pwd'];
    $q=$user->checkUser($data);
    if( $q == 1){
        //redirect('signup.php', 'Something went wrong!', 'danger');
       
            header('Location: dashboard.php');
        
        
    } else{
        header('Location: signin.php?error=wrongpwd');
    } 
}
//template
$template = new Template('templates/signin.php');

//page title
$template->title = 'Sign in';

echo $template;