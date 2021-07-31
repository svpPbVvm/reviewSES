<?php

namespace models\enum\response;


use models\enum\Enum;

/**
 * Class ResponseParams
 * @package models\enum\response
 */
class ResponseNeededParams extends Enum
{
    public const SUCCESS = 'success';
    public const ERROR = 'error';
}
