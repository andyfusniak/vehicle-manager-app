<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Mapper\ImageMapper;

class ImageMapperFactory implements FactoryInterface
{
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ImageMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Serenity\Hydrator\ImageDbHydrator')
        );
    }
}
