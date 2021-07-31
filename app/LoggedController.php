<?php

namespace app;


use models\enum\response\ResponseNeededParams;

/**
 * Class LoggedController
 * @package app
 */
class LoggedController extends BaseController
{
    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        if (!Application::isLogged()) {
            $this->response
                ->setResponseCode(401)
                ->response([
                    ResponseNeededParams::SUCCESS => false,
                    ResponseNeededParams::ERROR => "unauthorized",
                ]);
        }
    }
}