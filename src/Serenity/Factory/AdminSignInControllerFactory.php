<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\AdminSignInController;

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
            $serviceLocator->get('Serenity\Form\AdminSignInForm')
        );
    }
}
