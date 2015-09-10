<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\View\View;
use Nitrogen\View\ViewModel;
use Nitrogen\View\PhpRenderer;
use Nitrogen\View\HelperPluginManager;
use Nitrogen\View\Helper;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;

// FORM
$form = new Form();

// VIEW
$helperPluginManager = new HelperPluginManager();

$layoutModel = new ViewModel(array(
    'content' => 'layout content',
    'a' => phpversion()
));
$layoutModel->setTemplate('view/layout/layout.phtml');

$modelA = new ViewModel(array(
    'form' => '<div>test</div>',
    'a'    => 'view model A',
    'this' => 'splat'
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
