<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Validator\VehicleUrlTakenValidator;

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
            $serviceLocator->get('Serenity\Service\VehicleService')
        );
    }
}
