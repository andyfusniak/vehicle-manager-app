<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\View\View;
use Nitrogen\View\ViewModel;
use Nitrogen\View\PhpRenderer;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\View\Helper;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;

use Serenity\Form\VehicleForm;

// Service Manager
$helperPluginManager = new HelperPluginManager();

// FORM with validation inside
$vehicleForm = new VehicleForm($helperPluginManager);
$vehicleForm->setData([
    'url'       => 'camper-van-for-sale',
    'price'     => 'abc',
    'meta-desc' => '<span>'
]);

var_dump($vehicleForm->isValid());
var_dump($vehicleForm->get('price')->getMessages());


// VIEW
$view = new View();
$layoutModel = new ViewModel(array(
    'content' => 'layout content',
    'a' => phpversion()
));
$layoutModel->setTemplate('view/layout/layout.phtml');

$modelA = new ViewModel(array(
    'form' => $vehicleForm
));
$modelA->setTemplate('view/add-edit-vehicle/add-edit.phtml')
       ->setCaptureTo('content');

$menu = new ViewModel(array(
    'b' => '<ul><li>My menu</li></ul>'
));
$menu->setTemplate('view/layout/menu.phtml')
     ->setCaptureTo('menu');

$layoutModel->addChild($modelA)
            ->addChild($menu);

$renderer = new PhpRenderer();
$renderer->setHelperPluginManager($helperPluginManager);

$view = new View();
$view->setRenderer($renderer);


echo $view->render($layoutModel);

echo ceil((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000.0) . ' ms';
