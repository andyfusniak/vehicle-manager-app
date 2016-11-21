<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\CollectionController;

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
            $serviceLocator->get('Vm\Form\CollectionForm'),
            $serviceLocator->get('Vm\Service\CollectionService'),
            $serviceLocator->get('Vm\Service\ImageService'),
            $serviceLocator->get('config')
        );
    }
}
