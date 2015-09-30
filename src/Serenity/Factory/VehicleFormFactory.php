<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Form\VehicleForm;

class VehicleFormFactory implements FactoryInterface
{
    /**
     * Create a VehicleForm object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return VehicleForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleForm(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager'),
            $serviceLocator->get('Serenity\Validator\VehicleUrlTakenValidator'),
            $serviceLocator->get('Serenity\Service\CollectionService')
        );
    }
}
