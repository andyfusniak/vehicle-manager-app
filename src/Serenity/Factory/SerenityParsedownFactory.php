<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Serenity\Service\SerenityParsedown;

class SerenityParsedownFactory implements FactoryInterface
{
    /**
     * Create a SerenityParsedown instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return SerenityParsedown
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SerenityParsedown();
    }
}
