<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Validator\PageUrlTakenValidator;

class PageUrlTakenValidatorFactory implements FactoryInterface
{
    /**
     * Create a PageUrlTakenValidator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PageUrlTakenValidator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageUrlTakenValidator(
            $serviceLocator->get('Vm\Service\PageService'),
            $serviceLocator->get('Vm\Service\VehicleService')
        );
    }
}
