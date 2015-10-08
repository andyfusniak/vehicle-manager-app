<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\View\Helper\VehicleCategoryNav;

class VehicleCategoryNavFactory implements FactoryInterface
{
    /**
     * Create a VehicleCategoryNav instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return VehicleCategoryNav
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleCategoryNav(
            $serviceLocator->get('Serenity\Service\VehicleService')
        );
    }
}
