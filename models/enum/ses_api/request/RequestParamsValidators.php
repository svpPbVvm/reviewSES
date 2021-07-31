<?php

namespace models\enum\ses_api\request;


use models\enum\Enum;

/**
 * Class RequestParamsValidators
 * @package models\enum\ses_api\request
 */
class RequestParamsValidators extends Enum
{
    public const CHECK_EMAIL = 1;
    public const CHECK_PASSWORD = 2;
}
