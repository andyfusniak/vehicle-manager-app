<?php
namespace Nitrogen\Mvc\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGenerator;


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

    public function dispatch(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        list($service, $action) = split(':', $this->match['_controller']);
        return $this->$action();
    }

}
