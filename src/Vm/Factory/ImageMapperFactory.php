<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Mapper\ImageMapper;

class ImageMapperFactory implements FactoryInterface
{
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ImageMapper(
            $serviceLocator->get('Pdo'),
            $serviceLocator->get('Vm\Hydrator\ImageDbHydrator')
        );
    }
}
