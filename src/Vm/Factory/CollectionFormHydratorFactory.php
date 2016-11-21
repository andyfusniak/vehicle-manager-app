<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Hydrator\CollectionFormHydrator;

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
