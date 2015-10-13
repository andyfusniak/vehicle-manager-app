<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

class ParsedownFactory implements FactoryInterface
{
    /**
     * Create a Parsedown object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Parsedown
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \Parsedown();
    }
}
