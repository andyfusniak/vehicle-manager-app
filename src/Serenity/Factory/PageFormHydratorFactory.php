<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Hydrator\PageFormHydrator;

class PageFormHydratorFactory implements FactoryInterface
{
    /**
     * Create a PageFormHydrator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PageFormHydrator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageFormHydrator();
    }
}
