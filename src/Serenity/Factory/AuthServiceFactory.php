<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Service\AuthService;

class AuthServiceFactory implements FactoryInterface
{
    /**
     * Create an AuthService instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AuthService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AuthService(
            $serviceLocator->get('Serenity\Mapper\AdminMapper')
        );
    }
}
