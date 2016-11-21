<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\FeaturedVehiclesController;

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
            $serviceLocator->get('Vm\Form\FeaturedVehiclesForm'),
            $serviceLocator->get('Vm\Service\VehicleService')
        );
    }
}
