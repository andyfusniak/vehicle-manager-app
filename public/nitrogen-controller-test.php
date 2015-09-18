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
use Serenity\Form\VehicleForm;
use Serenity\Mapper\VehicleMapper;
use Serenity\Service\VehicleService;
use Serenity\Hydrator\VehicleDbHydrator;
use Serenity\Hydrator\VehicleFormHydrator;

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


$vehicleMapperFactory = function() use ($pdo) {
    return new VehicleMapper($pdo, new VehicleDbHydrator());
};
$vehicleMapper = $vehicleMapperFactory();


$vehicleServiceFactory = function() use ($vehicleMapper) {
    return new VehicleService($vehicleMapper, new VehicleFormHydrator());
};
$vehicleService = $vehicleServiceFactory();

$vehicleForm = new VehicleForm($application->getHelperPluginManager(), $vehicleService);

$addEditController = new AddEditVehicleController($vehicleForm, $vehicleService);


// main layout
$layoutModel = new ViewModel();
$layoutModel->setTemplate('view/layout/layout.phtml');
$layoutModel->addChild($addEditController->addEditAction($application->getRequest())->setCaptureTo('content'));
echo $application->getView()->render($layoutModel);

echo ceil((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000.0) . ' ms';
