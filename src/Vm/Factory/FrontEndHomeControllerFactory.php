<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\FrontEndHomeController;

class FrontEndHomeControllerFactory implements FactoryInterface
{
    /**
     * Create an FrontEndHomeController instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FrontEndHomeController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FrontEndHomeController(
            $serviceLocator->get('Vm\Service\PageService'),
            $serviceLocator->get('Vm\Service\VehicleService')
        );
    }
}
