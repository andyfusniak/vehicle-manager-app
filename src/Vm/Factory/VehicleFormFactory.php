<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\VehicleForm;

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
            $serviceLocator->get('Vm\Validator\VehicleUrlTakenValidator'),
            $serviceLocator->get('Vm\Validator\SlugValidator'),
            $serviceLocator->get('Vm\Service\CollectionService')
        );
    }
}
