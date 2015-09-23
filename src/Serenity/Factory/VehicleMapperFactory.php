<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Serenity\Hydrator\VehicleDbHydrator;
use Serenity\Mapper\VehicleMapper;

class VehicleMapperFactory implements FactoryInterface
{
    /**
     * Create a VehicleMapper object
     * @param \PDO $pdo the database pdo object
     * @param VehicleDbHydrator $hydrator
     * @return VehicleMapper
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Serenity\Hydrator\VehicleDbHydrator')
        );
    }
}