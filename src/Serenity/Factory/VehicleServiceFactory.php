<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Service\VehicleService;

class VehicleServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleService(
            $serviceLocator->get('Serenity\Mapper\VehicleMapper'),
            $serviceLocator->get('Serenity\Hydrator\VehicleFormHydrator')
        );
    }
}
