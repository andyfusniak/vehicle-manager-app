<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Hydrator\CollectionDbHydrator;

class CollectionDbHydratorFactory implements FactoryInterface
{
    /**
     * Create a CollectionDbHydrator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CollectionDbHydrator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionDbHydrator();
    }
}
