<?php
namespace Serenity\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Serenity\Controller\PageController;

class PageControllerFactory implements FactoryInterface
{
    /**
     * Create an PageController object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PageController
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageController(
            $serviceLocator->get('Serenity\Form\PageForm'),
            $serviceLocator->get('Serenity\Service\PageService'),
            $serviceLocator->get('config')
        );
    }
}
