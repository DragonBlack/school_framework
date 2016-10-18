<?php
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('CONFIG', ROOT.DS.'config/main.php');

require_once(ROOT.DS.'framework/bootstrap.php');

\framework\School::$app->run();
