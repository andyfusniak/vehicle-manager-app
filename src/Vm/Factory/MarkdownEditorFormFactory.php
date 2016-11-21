<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\MarkdownEditorForm;

class MarkdownEditorFormFactory implements FactoryInterface
{
    /**
     * Create a VehicleForm instance
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return MarkdownEditorForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new MarkdownEditorForm();
    }
}
