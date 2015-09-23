<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Form\CollectionForm;

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
            $serviceLocator->get('Serenity\Validator\CollectionTagnameTakenValidator')
        );
    }
}
