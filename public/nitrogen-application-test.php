<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\Mvc\Application;
use Nitrogen\EventManager\EventManager;
use Nitrogen\ServiceManager\HelperPluginManager;

$config = [];
$helperPluginManager = new HelperPluginManager();
$eventManager = new EventManager();

$application = new Application(
    $config,
    $eventManager,
    $helperPluginManager
);

var_dump($application->getRequest());
$application->bootstrap();
$application->run();



echo ceil((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000.0) . ' ms';
