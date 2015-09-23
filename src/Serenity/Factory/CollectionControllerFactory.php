<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\CollectionController;

class CollectionControllerFactory implements FactoryInterface
{
    /**
     * Create an CollectionController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return CollectionController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new CollectionController(
            $serviceLocator->get('Serenity\Form\CollectionForm'),
            $serviceLocator->get('Serenity\Service\CollectionService')
        );
    }
}
