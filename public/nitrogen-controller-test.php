<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';
$config = require 'config.php';

use Nitrogen\Mvc\Application;
use Nitrogen\EventManager\EventManager;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\View\View;
use Nitrogen\View\ViewModel;

use Serenity\Controller\AddEditVehicleController;
use Serenity\Controller\ImageUploadController;

$application = Application::init($config);

$serviceLocator = $application->getServiceLocator();
$serviceLocator->setService($config['factories']);

$controller = new ImageUploadController(
    $serviceLocator->get('Serenity\Form\ImageUploadForm'),
    $serviceLocator->get('Serenity\Service\ImageService')
);
$viewModel = $controller->dispatch($application->getRequest(), $application->getResponse());
$viewModel = $viewModel->setCaptureTo('content');

// main layout
$layoutModel = new ViewModel();
$layoutModel->setTemplate('view/layout/layout.phtml');
$layoutModel->addChild($viewModel);

$application->getResponse()->setContent($application->getView()->render($layoutModel));
$application->getResponse()->send();

echo ceil((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000.0) . ' ms';
