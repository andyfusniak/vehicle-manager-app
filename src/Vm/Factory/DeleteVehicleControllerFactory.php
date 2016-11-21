<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\DeleteVehicleController;

class DeleteVehicleControllerFactory implements FactoryInterface
{
    /**
     * Create a DeleteVehicleController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return DeleteVehicleController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DeleteVehicleController(
            $serviceLocator->get('Vm\Service\VehicleService'),
            $serviceLocator->get('config')
        );
    }
}
