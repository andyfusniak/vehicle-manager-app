<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Serenity\Hydrator\AdminDbHydrator;
use Serenity\Mapper\AdminMapper;

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
            $serviceLocator->get('Serenity\Hydrator\AdminDbHydrator')
        );
    }
}
