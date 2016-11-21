<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Hydrator\VehicleDbHydrator;

class VehicleDbHydratorFactory implements FactoryInterface
{
    /**
     * Create a VehicleDbHydrator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return VehicleDbHydrator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleDbHydrator();
    }
}
