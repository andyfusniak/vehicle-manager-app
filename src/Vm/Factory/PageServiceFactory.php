<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Service\PageService;

class PageServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return PageService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageService(
            $serviceLocator->get('Vm\Mapper\PageMapper'),
            $serviceLocator->get('Vm\Hydrator\PageDbHydrator'),
            $serviceLocator->get('Vm\Hydrator\PageFormHydrator')
        );
    }
}
