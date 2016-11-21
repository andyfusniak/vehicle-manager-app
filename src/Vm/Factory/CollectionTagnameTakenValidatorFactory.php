<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Validator\CollectionTagnameTakenValidator;

class CollectionTagnameTakenValidatorFactory implements FactoryInterface
{
    /**
     * Create a CollectionTagnameTakenValidator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CollectionTagnameTakenValidator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionTagnameTakenValidator(
            $serviceLocator->get('Vm\Service\CollectionService')
        );
    }
}
