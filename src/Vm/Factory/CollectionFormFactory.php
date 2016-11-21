<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\CollectionForm;

class CollectionFormFactory implements FactoryInterface
{
    /**
     * Create a CollectionForm object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CollectionForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionForm(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager'),
            $serviceLocator->get('Vm\Validator\CollectionTagnameTakenValidator'),
            $serviceLocator->get('Vm\Validator\NameReferenceValidator'),
            $serviceLocator->get('Vm\Validator\SlugValidator')
        );
    }
}
