<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Form\AdminSignInForm;

class AdminSignInFormFactory implements FactoryInterface
{
    /**
     * Create an AdminSignInForm instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AdminSignInForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AdminSignInForm();
    }
}
