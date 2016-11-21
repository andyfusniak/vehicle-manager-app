<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Hydrator\PageDbHydrator;

class PageDbHydratorFactory implements FactoryInterface
{
    /**
     * Create a PageDbHydrator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PageDbHydrator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageDbHydrator();
    }
}
