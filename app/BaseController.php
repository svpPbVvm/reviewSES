<?php

namespace app;


/**
 * Class BaseController
 * @package app
 */
class BaseController
{
    /**
     * @var Response
     */
    protected Response $response;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->response = new Response();
    }
}
