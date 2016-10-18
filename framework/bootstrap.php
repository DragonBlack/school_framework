<?php
defined('FRAMEWORK') or define('FRAMEWORK', __DIR__);
defined('ROOT') or define('ROOT', dirname(__DIR__));
defined('CONFIG') or define('CONFIG', FRAMEWORK.DIRECTORY_SEPARATOR.'config/main.php');

spl_autoload_register(function($className){
    $fileName = ROOT.DIRECTORY_SEPARATOR.$className.'.php';
    if(file_exists($fileName)){
        require_once $fileName;
    }
});

\framework\School::getInstance();