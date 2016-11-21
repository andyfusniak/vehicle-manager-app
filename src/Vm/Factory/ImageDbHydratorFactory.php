<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Hydrator\ImageDbHydrator;

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
