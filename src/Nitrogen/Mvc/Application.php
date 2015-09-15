<?php
namespace Nitrogen\Mvc;

use Nitrogen\Http\Request;
use Nitrogen\Http\Response;

class Application
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function run()
    {

    }
}
