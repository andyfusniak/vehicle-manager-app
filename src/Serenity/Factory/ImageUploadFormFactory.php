<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Form\ImageUploadForm;

class ImageUploadFormFactory implements FactoryInterface
{
    /**
     * Create a ImageUploadForm object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageUploadForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ImageUploadForm(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager')
        );
    }
}
