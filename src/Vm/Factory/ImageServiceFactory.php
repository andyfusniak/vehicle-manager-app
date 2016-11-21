<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Service\ImageService;

class ImageServiceFactory implements FactoryInterface
{
    /**
     * Create a ImageService object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageService
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ImageService(
            $serviceLocator->get('config'),
            $serviceLocator->get('Vm\Mapper\ImageMapper'),
            $serviceLocator->get('Vm\Hydrator\ImageDbHydrator')
        );
    }
}
