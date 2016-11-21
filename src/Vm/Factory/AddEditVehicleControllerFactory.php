<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\AddEditVehicleController;

class AddEditVehicleControllerFactory implements FactoryInterface
{
    /**
     * Create an AddEditVehicleController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AddEditVehicleController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AddEditVehicleController(
            $serviceLocator->get('Vm\Form\VehicleForm'),
            $serviceLocator->get('Vm\Service\VehicleService')
        );
    }
}
