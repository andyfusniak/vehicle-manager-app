<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Vm\Hydrator\PageDbHydrator;
use Vm\Mapper\PageMapper;

class PageMapperFactory implements FactoryInterface
{
    /**
     * Create a PageMapper object
     *
     * @return PageMapper
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Vm\Hydrator\PageDbHydrator'),
            $serviceLocator->get('Vm\Service\VmParsedown')
        );
    }
}
