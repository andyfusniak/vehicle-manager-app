<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\AddEditVehicleController;

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
            $serviceLocator->get('Serenity\Form\VehicleForm'),
            $serviceLocator->get('Serenity\Service\VehicleService')
        );
    }
}
