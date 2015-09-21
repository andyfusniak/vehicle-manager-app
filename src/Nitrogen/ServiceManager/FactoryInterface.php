<?php
namespace Nitrogen\ServiceManager;

interface FactoryInterface
{
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator);
}
