<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\FeaturedVehiclesController;

class FeaturedVehiclesControllerFactory implements FactoryInterface
{
    /**
     * Create an FeaturedVehiclesController instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FeaturedVehiclesController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FeaturedVehiclesController(
            $serviceLocator->get('Serenity\Form\FeaturedVehiclesForm'),
            $serviceLocator->get('Serenity\Service\VehicleService')
        );
    }
}
