<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\ImageUploadForm;

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
        $collectionService = $serviceLocator->get('Vm\Service\CollectionService');

        return new ImageUploadForm(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager'),
            $collectionService->collectionsValueOptions()
        );
    }
}
