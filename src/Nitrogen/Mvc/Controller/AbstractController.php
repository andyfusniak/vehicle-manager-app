<?php
namespace Nitrogen\Mvc\Controller;

use Nitrogen\Http\Request;
use Nitrogen\Http\Response;

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

    }
}
