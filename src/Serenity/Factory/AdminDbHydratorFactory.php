<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Hydrator\AdminDbHydrator;

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
