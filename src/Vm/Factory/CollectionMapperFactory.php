<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Mapper\CollectionMapper;

class CollectionMapperFactory implements FactoryInterface
{
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Vm\Hydrator\CollectionDbHydrator')
        );
    }
}
