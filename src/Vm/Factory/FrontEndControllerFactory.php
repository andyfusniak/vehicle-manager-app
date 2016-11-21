<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\FrontEndController;

class FrontEndControllerFactory implements FactoryInterface
{
    /**
     * Create an FrontEndController instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FrontEndController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FrontEndController(
            $serviceLocator->get('Vm\Service\PageService'),
            $serviceLocator->get('Vm\Service\VehicleService')
        );
    }
}
