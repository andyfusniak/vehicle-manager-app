<?php
namespace Nitrogen\Mvc;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class RouteCollectionFactory
{
    /**
     * @param array $config an array of routes
     * @return RouteCollection
     */
    public static function buildRoutes($config)
    {
        $routes = new RouteCollection();

        foreach ($config as $name => $argv) {
            $routes->add($name, new Route(
                $argv['path'],
                isset($argv['defaults'])     ? $argv['defaults']     : [],
                isset($argv['requirements']) ? $argv['requirements'] : [],
                isset($argv['options'])      ? $argv['options']      : [],
                isset($argv['host'])         ? $argv['host']         : '',
                isset($argv['schemes'])      ? $argv['schemes']      : [],
                isset($argv['methods'])      ? $argv['methods']      : [],
                isset($argv['condition'])    ? $argv['condition']    : ''
            ));
        }
        return $routes;
    }
}
