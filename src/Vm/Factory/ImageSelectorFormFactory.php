<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\ImageSelectorForm;

class ImageSelectorFormFactory implements FactoryInterface
{
    /**
     * Create a ImageSelectorForm instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ImageSelectorForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ImageSelectorForm(
            $serviceLocator->get('Vm\Service\CollectionService')
        );
    }
}
