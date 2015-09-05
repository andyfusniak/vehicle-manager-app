<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Zend\View\View;
use Zend\View\Model\ViewModel;

$v = new View();
$vm = new ViewModel();

$v->render($vm);

var_dump($v);
var_dump($vm);


