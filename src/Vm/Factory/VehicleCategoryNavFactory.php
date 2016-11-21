<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\View\Helper\VehicleCategoryNav;

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
            $serviceLocator->get('Vm\Service\VehicleService'),
            $serviceLocator->get('Vm\Service\PageService')
        );
    }
}
