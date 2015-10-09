<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\FrontEndHomeController;

class FrontEndHomeControllerFactory implements FactoryInterface
{
    /**
     * Create an FrontEndHomeController instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FrontEndHomeController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FrontEndHomeController(
            $serviceLocator->get('Serenity\Service\PageService'),
            $serviceLocator->get('Serenity\Service\VehicleService')
        );
    }
}
