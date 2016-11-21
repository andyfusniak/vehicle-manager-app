<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\View\Helper\FooterNav;

class FooterNavFactory implements FactoryInterface
{
    /**
     * Create a FooterNav instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FooterNav
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FooterNav(
            $serviceLocator->get('Vm\Service\PageService')
        );
    }
}
