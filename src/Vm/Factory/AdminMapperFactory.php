<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Vm\Hydrator\AdminDbHydrator;
use Vm\Mapper\AdminMapper;

class AdminMapperFactory implements FactoryInterface
{
    /**
     * Create an AdminMapper instance
     *
     * @return AdminMapper
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AdminMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Vm\Hydrator\AdminDbHydrator')
        );
    }
}
