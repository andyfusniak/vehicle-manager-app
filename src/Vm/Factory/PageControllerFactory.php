<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Controller\PageController;

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
            $serviceLocator->get('Vm\Form\PageForm'),
            $serviceLocator->get('Vm\Service\PageService'),
            $serviceLocator->get('config')
        );
    }
}
