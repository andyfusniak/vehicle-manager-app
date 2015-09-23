<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Mapper\CollectionMapper;

class CollectionMapperFactory implements FactoryInterface
{
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Serenity\Hydrator\CollectionDbHydrator')
        );
    }
}
