<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\View\Helper\FooterNav;

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
            $serviceLocator->get('Serenity\Service\PageService')
        );
    }
}
