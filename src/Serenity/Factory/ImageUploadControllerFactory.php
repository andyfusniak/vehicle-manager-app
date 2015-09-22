<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\ImageUploadController;

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
            $serviceLocator->get('Serenity\Form\ImageUploadForm'),
            $serviceLocator->get('Serenity\Service\ImageService')
        );
    }
}
