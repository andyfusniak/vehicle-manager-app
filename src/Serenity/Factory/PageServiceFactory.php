<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Service\PageService;

class PageServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return PageService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageService(
            $serviceLocator->get('Serenity\Mapper\PageMapper'),
            $serviceLocator->get('Serenity\Hydrator\PageDbHydrator'),
            $serviceLocator->get('Serenity\Hydrator\PageFormHydrator')
        );
    }
}
