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
use Serenity\Form\VehicleForm;
use Serenity\Form\ImageUploadForm;
use Serenity\Mapper\ImageMapper;
use Serenity\Mapper\VehicleMapper;
use Serenity\Service\VehicleService;
use Serenity\Service\ImageService;
use Serenity\Hydrator\VehicleDbHydrator;
use Serenity\Hydrator\VehicleFormHydrator;
use Serenity\Hydrator\ImageDbHydrator;

$application = Application::init($config);

$pdoFactory = function() use ($config) {
    try {
        $pdo = new PDO(
            'mysql:host=' . $config['db']['hostname'] . ';dbname=' . $config['db']['database'],
            $config['db']['username'],
            $config['db']['password']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        var_dump($e->getMessage());
        return null;
    }
};
$pdo = $pdoFactory();


// vehicle mapper
$vehicleMapperFactory = function() use ($pdo) {
    return new VehicleMapper($pdo, new VehicleDbHydrator());
};
$vehicleMapper = $vehicleMapperFactory();


// image mapper
$imageMapperFactory = function() use ($pdo) {
    return new ImageMapper($pdo, new ImageDbHydrator());
};
$imageMapper = $imageMapperFactory();


// vehicle service
$vehicleServiceFactory = function() use ($vehicleMapper) {
    return new VehicleService($vehicleMapper, new VehicleFormHydrator());
};
//$vehicleService = $vehicleServiceFactory();


// image service
$imageServiceFactory = function() use ($config, $imageMapper) {
    return new ImageService($config, $imageMapper);
};
$imageService = $imageServiceFactory();

//$vehicleForm = new VehicleForm($application->getHelperPluginManager(), $vehicleService);

$imageUploadForm = new ImageUploadForm($application->getHelperPluginManager());

$imageService = new ImageService($config, $imageMapper);

$controller = new ImageUploadController($imageUploadForm, $imageService);
$viewModel = $controller->dispatch($application->getRequest(), $application->getResponse());
$viewModel = $viewModel->setCaptureTo('content');

// main layout
$layoutModel = new ViewModel();
$layoutModel->setTemplate('view/layout/layout.phtml');
$layoutModel->addChild($viewModel);


$application->getResponse()->setContent($application->getView()->render($layoutModel));
$application->getResponse()->send();

echo ceil((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000.0) . ' ms';
