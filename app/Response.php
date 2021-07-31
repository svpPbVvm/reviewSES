<?php

namespace app;


use models\enum\response\ResponseNeededParams;

/**
 * Class Response
 * @package app
 */
class Response
{
    /**
     * @var int
     */
    protected int $responseCode = 200;

    /**
     * @param array $params
     * @throws \Exception
     */
    public function response(array $params): void
    {
        foreach (ResponseNeededParams::getConstants() as $neededParam) {
            if (!array_key_exists($neededParam, $params)) {
                throw new \Exception("Response param \"$neededParam\" is undefined");
            }
        }

        http_response_code($this->responseCode);
        echo json_encode($params, JSON_ERROR_UTF8);
        die();
    }

    /**
     * @param int $responseCode
     * @return $this
     */
    public function setResponseCode(int $responseCode): Response
    {
        $this->responseCode = $responseCode;
        return $this;
    }
}
