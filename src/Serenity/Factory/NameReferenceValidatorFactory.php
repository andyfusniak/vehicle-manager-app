<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Validator\NameReferenceValidator;

class NameReferenceValidatorFactory implements FactoryInterface
{
    /**
     * Create a NameReferenceValidator instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return NameReferenceValidator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new NameReferenceValidator();
    }
}
