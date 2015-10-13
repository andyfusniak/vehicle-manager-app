<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;
use Serenity\Hydrator\PageDbHydrator;
use Serenity\Mapper\PageMapper;

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
            $serviceLocator->get('Serenity\Hydrator\PageDbHydrator'),
            $serviceLocator->get('Serenity\Service\SerenityParsedown')
        );
    }
}
