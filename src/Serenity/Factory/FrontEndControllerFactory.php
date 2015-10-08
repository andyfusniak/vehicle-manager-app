<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\FrontEndController;

class FrontEndControllerFactory implements FactoryInterface
{
    /**
     * Create an FrontEndController instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FrontEndController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FrontEndController(
            $serviceLocator->get('Serenity\Service\PageService'),
            $serviceLocator->get('Serenity\Service\VehicleService')
        );
    }
}
