<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\SettingsController;

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
