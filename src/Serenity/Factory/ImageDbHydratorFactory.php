<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Hydrator\ImageDbHydrator;

class ImageDbHydratorFactory implements FactoryInterface
{
    /**
     * Create a ImageDbHydrator object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageDbHydrator
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ImageDbHydrator();
    }
}
