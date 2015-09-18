<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Zend\Http\Request;

$request = new Request();

var_dump($request->getQuery());
die();

$config = [];
Zend\Mvc\Application::init($config)->run();
