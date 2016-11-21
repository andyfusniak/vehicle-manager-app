<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Hydrator\AdminDbHydrator;

class AdminDbHydratorFactory implements FactoryInterface
{
    /**
     * Create an AdminDbHydrator instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AdminDbHydrator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AdminDbHydrator();
    }
}
