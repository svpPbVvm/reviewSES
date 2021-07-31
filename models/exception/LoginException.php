<?php

namespace models\exception;


/**
 * Class LoginException
 * @package models\exception
 */
class LoginException extends CustomException
{
    public const RESPONSE_CODE = 401;
}
