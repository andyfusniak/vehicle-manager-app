<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Validator\PageUrlTakenValidator;

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
            $serviceLocator->get('Serenity\Service\PageService')
        );
    }
}
