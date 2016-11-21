<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\ImageUploadController;

class ImageUploadControllerFactory implements FactoryInterface
{
    /**
     * Create a ImageUploadController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageUploadController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ImageUploadController(
            $serviceLocator->get('Vm\Form\ImageUploadForm'),
            $serviceLocator->get('Vm\Service\ImageService')
        );
    }
}
