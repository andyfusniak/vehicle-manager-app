<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\AdminSignInForm;

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
        return new AdminSignInForm(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager'),
            $serviceLocator->get('Vm\Validator\UsernameValidator')
        );
    }
}
