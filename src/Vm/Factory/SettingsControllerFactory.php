<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\SettingsController;

class SettingsControllerFactory implements FactoryInterface
{
    /**
     * Create an SettingsController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return SettingsController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SettingsController();
    }
}
