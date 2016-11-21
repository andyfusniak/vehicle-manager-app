<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Service\VehicleService;

class VehicleServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleService(
            $serviceLocator->get('Vm\Mapper\VehicleMapper'),
            $serviceLocator->get('Vm\Hydrator\VehicleFormHydrator'),
            $serviceLocator->get('Vm\Hydrator\VehicleDbHydrator'),
            $serviceLocator->get('Vm\Service\CollectionService')
        );
    }
}
