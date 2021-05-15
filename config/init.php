<?php
//start session
session_start();

//config file
require_once 'config.php';

//helpers
require_once 'system_helpers.php';

//autoload classes

function __autoload($className){
    require_once 'lib/'.$className.'.php';
}