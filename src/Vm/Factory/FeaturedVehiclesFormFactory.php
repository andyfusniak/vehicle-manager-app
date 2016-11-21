<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\FeaturedVehiclesForm;

class FeaturedVehiclesFormFactory implements FactoryInterface
{
    /**
     * Create a FeaturedVehiclesForm instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return FeatureVehiclesForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FeaturedVehiclesForm(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager'),
            $serviceLocator->get('Vm\Service\VehicleService')
        );
    }
}
