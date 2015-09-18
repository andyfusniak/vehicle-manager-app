<?php
namespace Nitrogen\Mvc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nitrogen\EventManager\EventManager;
use Nitrogen\EventManager\Event;
use Nitrogen\ServiceManager\HelperPluginManager;
use Nitrogen\View\View;
use Nitrogen\View\PhpRenderer;

class Application
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var EventManager
     */
    protected $eventManager;

    /**
     * @var Event
     */
    protected $event;

    /**
     * @var HelperPluginManager
     */
    protected $helperPluginManager;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public function __construct($configuration,
                                EventManager $eventManager,
                                HelperPluginManager $helperPluginManager,
                                View $view)
    {
        $this->configuration = $configuration;
        $this->eventManager = $eventManager;
        $this->helperPluginManager = $helperPluginManager;
        $this->view = $view;
        $this->request = Request::createFromGlobals();
    }

    /**
     * Prebaked Application
     *
     * @return Application
     */
    public static function init($configuration)
    {
        $helperPluginManager = new HelperPluginManager();

        $view = new View();
        $renderer = new PhpRenderer();
        $renderer->setHelperPluginManager($helperPluginManager);
        $view->setRenderer($renderer);

        return new Application(
            $configuration,
            new EventManager(),
            $helperPluginManager,
            $view
        );
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return HelperPluginManager
     */
    public function getHelperPluginManager()
    {
        return $this->helperPluginManager;
    }

    public function getView()
    {
        return $this->view;
    }

    /**
     * @return Application
     */
    public function bootstrap()
    {
        $this->event = $event = new Event();
        $this->eventManager->trigger(Event::EVENT_BOOTSTRAP, $event);
        return $this;
    }

    public function run()
    {
        $event = $this->event;

        $result = $this->eventManager->trigger(Event::EVENT_ROUTE, $event);

        $result = $this->eventManager->trigger(Event::EVENT_DISPATCH, $event);

        return $this;
    }
}
