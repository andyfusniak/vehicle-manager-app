<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\View\Helper\PageNav;

class PageNavFactory implements FactoryInterface
{
    /**
     * Create a PageNav instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return pageNav
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageNav(
            $serviceLocator->get('Serenity\Service\PageService')
        );
    }
}
