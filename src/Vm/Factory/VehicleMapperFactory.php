<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Vm\Hydrator\VehicleDbHydrator;
use Vm\Mapper\VehicleMapper;

class VehicleMapperFactory implements FactoryInterface
{
    /**
     * Create a VehicleMapper object
     *
     * @return VehicleMapper
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Vm\Hydrator\VehicleDbHydrator'),
            $serviceLocator->get('Vm\Service\VmParsedown')
        );
    }
}
