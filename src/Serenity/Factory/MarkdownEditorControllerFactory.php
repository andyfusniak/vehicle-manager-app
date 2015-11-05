<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\MarkdownEditorController;

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
            $serviceLocator->get('Serenity\Form\MarkdownEditorForm')
        );
    }
}
