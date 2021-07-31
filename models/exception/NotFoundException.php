<?php

namespace models\exception;


/**
 * Class NotFoundException
 * @package models\exception
 */
class NotFoundException extends CustomException
{
    public const RESPONSE_CODE = 404;
}
