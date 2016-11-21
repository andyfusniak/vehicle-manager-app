<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\AdminSignInController;

class AdminSignInControllerFactory implements FactoryInterface
{
    /**
     * Create an AdminSignInController instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AdminSignInController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AdminSignInController(
            $serviceLocator->get('Vm\Form\AdminSignInForm'),
            $serviceLocator->get('Vm\Service\AuthService')
        );
    }
}
