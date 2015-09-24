<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\DashboardController;

class DashboardControllerFactory implements FactoryInterface
{
    /**
     * Create an DashboardController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return DashboardController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DashboardController();
    }
}
