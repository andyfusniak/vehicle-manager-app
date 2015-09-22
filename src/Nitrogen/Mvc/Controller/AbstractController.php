<?php
namespace Nitrogen\Mvc\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function setMatch(array $match)
    {
        $this->match = $match;
    }

    public function dispatch(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        list($service, $action) = split(':', $this->match['_controller']);
        return $this->$action();
    }
}
