<?php

require_once ROOT . DIRECTORY_SEPARATOR . "functions.php";

spl_autoload_register(function($class_name){
    require_once ROOT . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
});
