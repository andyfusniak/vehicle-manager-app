<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\DeleteVehicleController;

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
            $serviceLocator->get('Serenity\Service\VehicleService'),
            $serviceLocator->get('config')
        );
    }
}
