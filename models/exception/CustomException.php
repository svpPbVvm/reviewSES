<?php

namespace models\exception;


/**
 * Class CustomException
 * @package models\exception
 */
abstract class CustomException extends \Exception
{
    public const RESPONSE_CODE = 500;
}
