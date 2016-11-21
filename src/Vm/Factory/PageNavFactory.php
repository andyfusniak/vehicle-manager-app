<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\View\Helper\PageNav;

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
            $serviceLocator->get('Vm\Service\PageService')
        );
    }
}
