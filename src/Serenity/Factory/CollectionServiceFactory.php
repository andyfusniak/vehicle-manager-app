<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Service\CollectionService;

class CollectionServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CollectionService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionService(
            $serviceLocator->get('Serenity\Mapper\CollectionMapper'),
            $serviceLocator->get('Serenity\Hydrator\CollectionFormHydrator'),
            $serviceLocator->get('Serenity\Hydrator\CollectionDbHydrator'),
            $serviceLocator->get('Serenity\Service\ImageService')
        );
    }
}
