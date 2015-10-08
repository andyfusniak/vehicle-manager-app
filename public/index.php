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

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\RedirectResponse;


$session = new Session();
$session->start();

$application = Application::init($config);

$serviceLocator = $application->getServiceLocator();

// MATCH THE ROUTE
$request = $application->getRequest();
$response = $application->getResponse();

try {
    $context = new Routing\RequestContext();
    $context->fromRequest($request);
    $matcher = new Routing\Matcher\UrlMatcher($application->getRoutes(), $context);
    $parameters = $matcher->match($request->getPathInfo());

    $generator = new Routing\Generator\UrlGenerator($application->getRoutes(), $context);

    list($service, $action) = split(':', $parameters['_controller']);

    $controller = $serviceLocator->get($service);
    $controller->setMatch($parameters);
    $controller->setUrlGenerator($generator);

    // main layout (set based on the route)
    $layoutModel = new ViewModel([
        'admin' => $session->get('admin')
    ]);

    $signInOpenRoutes = [
        'admin_sign_in',
        'admin_create_admin_temp',
        'admin_sign_in_failed'
    ];

    if (isset($parameters['_route']) && (in_array($parameters['_route'], $signInOpenRoutes))) {
        $layoutModel->setTemplate('view/layout/admin-sign-in-layout.phtml');
    } else if (isset($parameters['_route']) && (substr($parameters['_route'], 0, 5) === 'admin')) {
        // restrict access to main admin app
        $admin = $session->get('admin');
        if ($admin === null) {
            $response = new RedirectResponse('/admin/sign-in');
            $response->send();
            die();
        }
        $layoutModel->setTemplate('view/layout/layout.phtml');
    } else {
        $layoutModel->setTemplate('view/layout/frontend-layout.phtml');
    }
    $viewModel = $controller->dispatch($application->getRequest(), $response);
    $viewModel = $viewModel->setCaptureTo('content');

    // inject the ViewModel into the main layout view
    $layoutModel->addChild($viewModel);

    $response->setContent($application->getView()->render($layoutModel));
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response->setContent('Not Found');
    $response->setStatusCode(404);
} catch (Exception $e) {
    throw $e;
    $response->setContent('An error occurred');
    $response->setStatusCode(500);
}

$response->send();

//echo 'Page load time ' .ceil((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000.0) . ' ms';
