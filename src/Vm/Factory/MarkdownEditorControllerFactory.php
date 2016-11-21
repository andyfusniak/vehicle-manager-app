<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\MarkdownEditorController;

class MarkdownEditorControllerFactory implements FactoryInterface
{
    /**
     * Create an MarkdownEditorController instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return MarkdownEditorController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new MarkdownEditorController(
            $serviceLocator->get('Vm\Form\MarkdownEditorForm'),
            $serviceLocator->get('Vm\Form\ImageSelectorForm'),
            $serviceLocator->get('Vm\Service\VehicleService'),
            $serviceLocator->get('Vm\Service\PageService'),
            $serviceLocator->get('Vm\Service\CollectionService')
        );
    }
}
