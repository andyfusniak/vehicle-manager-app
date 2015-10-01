<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Validator\UsernameValidator;

class UsernameValidatorFactory implements FactoryInterface
{
    /**
     * Create a UsernameValidator instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return UsernameValidator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new UsernameValidator();
    }
}
