<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Hydrator\VehicleFormHydrator;

class VehicleFormHydratorFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleFormHydrator(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager'),
            $serviceLocator->get('Serenity\Service\VehicleService')
        );
    }
}
