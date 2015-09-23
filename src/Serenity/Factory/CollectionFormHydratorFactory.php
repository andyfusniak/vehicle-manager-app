<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Hydrator\CollectionFormHydrator;

class CollectionFormHydratorFactory implements FactoryInterface
{
    /**
     * Create a CollectionFormHydrator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CollectionFormHydrator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionFormHydrator();
    }
}
