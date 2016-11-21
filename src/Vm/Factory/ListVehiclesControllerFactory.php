<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\ListVehiclesController;

class ListVehiclesControllerFactory implements FactoryInterface
{
    /**
     * Create a ListVehiclesController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ListVehiclesController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ListVehiclesController(
            $serviceLocator->get('Vm\Service\VehicleService'),
            $serviceLocator->get('config')
        );
    }
}
