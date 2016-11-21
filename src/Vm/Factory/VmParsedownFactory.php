<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Vm\Service\VmParsedown;

class VmParsedownFactory implements FactoryInterface
{
    /**
     * Create a VmParsedown instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return VmParsedown
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new VmParsedown();
    }
}
