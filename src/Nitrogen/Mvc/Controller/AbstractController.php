<?php
namespace Nitrogen\Mvc\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGenerator;

use Nitrogen\View\ViewModel;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $match;

    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;

    /**
     * @var ViewModel the root view model (layout)
     */
    protected $layout;

    public function setMatch(array $match)
    {
        $this->match = $match;
        return $this;
    }

    /**
     * @param UrlGenerator $urlGenerator
     */
    public function setUrlGenerator($urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
        return $this;
    }

    public function getRouteParam($name, $default = null)
    {
        if (isset($this->match[$name])) {
            return $this->match[$name];
        }
        return $default;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function redirectToRoute($name, $params = [])
    {
        $url = $this->urlGenerator->generate($name, $params);
        return $this->redirectToUrl($url);
    }

    public function redirectToUrl($url)
    {
        $response = new RedirectResponse($url);
        $response->send();
        die();
    }

    /**
     * @param ViewModel $viewModel the root view model (layout)
     * @return AbstractController
     */
    public function setLayout(ViewModel $viewModel)
    {
        $this->layout = $viewModel;
        return $this;
    }

    /**
     * @return ViewModel the root view model (layout)
     */
    public function getLayout()
    {
        return $this->layout;
    }

    public function dispatch(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        list($service, $action) = preg_split('/:/', $this->match['_controller']);
        return $this->$action();
    }

}
