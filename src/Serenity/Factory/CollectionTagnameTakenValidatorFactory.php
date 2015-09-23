<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Validator\CollectionTagnameTakenValidator;

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
            $serviceLocator->get('Serenity\Service\CollectionService')
        );
    }
}
