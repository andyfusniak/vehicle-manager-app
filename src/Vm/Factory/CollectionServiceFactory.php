<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Service\CollectionService;

class CollectionServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return CollectionService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionService(
            $serviceLocator->get('Vm\Mapper\CollectionMapper'),
            $serviceLocator->get('Vm\Hydrator\CollectionFormHydrator'),
            $serviceLocator->get('Vm\Hydrator\CollectionDbHydrator'),
            $serviceLocator->get('Vm\Service\ImageService')
        );
    }
}
