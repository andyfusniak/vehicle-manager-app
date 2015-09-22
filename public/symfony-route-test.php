<?php
chdir(dirname(__DIR__));

// Setup autoloading
require_once './vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$response = new Response();

$routes = new Routing\RouteCollection();
$routes->add('blog_show', new Routing\Route('/blog/{slug}', array(
    '_controller' => 'AppBundle:Blog:show',
)));

$context = new Routing\RequestContext();
$context->fromRequest($request);

$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());
    var_dump($parameters);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred', 500);
}
$response->send();
