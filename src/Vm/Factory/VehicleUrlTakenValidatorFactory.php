<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Validator\VehicleUrlTakenValidator;

class VehicleUrlTakenValidatorFactory implements FactoryInterface
{
    /**
     * Create a VehicleUrlTakenValidator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return VehicleUrlTakenValidator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VehicleUrlTakenValidator(
            $serviceLocator->get('Vm\Service\VehicleService'),
            $serviceLocator->get('Vm\Service\PageService')
        );
    }
}
