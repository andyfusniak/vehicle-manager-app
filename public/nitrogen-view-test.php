<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Nitrogen\View\View;
use Nitrogen\View\ViewModel;
use Nitrogen\View\PhpRenderer;

$viewModel = new ViewModel(array(
    'form' => '<div>test</div>'
));
$viewModel->setTemplate('view/add-edit-vehicle/add-edit.phtml');

$renderer = new PhpRenderer();

$view = new View();
$view->setRenderer($renderer);

$content = $view->render($viewModel);

echo $content;
