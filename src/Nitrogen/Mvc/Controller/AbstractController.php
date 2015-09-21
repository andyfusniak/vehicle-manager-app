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

    public function dispatch(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        return $this->uploadAction();
    }
}
