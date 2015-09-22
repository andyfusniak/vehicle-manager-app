<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Service\ImageService;

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
            $serviceLocator->get('Serenity\Mapper\ImageMapper')
        );
    }
}
