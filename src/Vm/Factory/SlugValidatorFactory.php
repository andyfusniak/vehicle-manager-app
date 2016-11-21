<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Validator\SlugValidator;

class SlugValidatorFactory implements FactoryInterface
{
    /**
     * Create a SlugValidator instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return SlugValidator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SlugValidator();
    }
}
