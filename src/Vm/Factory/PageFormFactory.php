<?php
namespace Vm\Factory;

use Nitrogen\ServiceManager\FactoryInterface;
use Nitrogen\ServiceManager\ServiceLocatorInterface;

use Vm\Form\PageForm;

class PageFormFactory implements FactoryInterface
{
    /**
     * Create a PageForm object
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PageForm
     */
    public static function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PageForm(
            $serviceLocator->get('Nitrogen\ServiceManager\HelperPluginManager'),
            $serviceLocator->get('Vm\Validator\PageUrlTakenValidator'),
            $serviceLocator->get('Vm\Service\PageService')
        );
    }
}
