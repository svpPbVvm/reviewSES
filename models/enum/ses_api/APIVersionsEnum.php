<?php

namespace models\enum\ses_api;


use models\enum\Enum;

/**
 * Class APIVersionsEnum
 * @package models\enum\ses_api
 */
class APIVersionsEnum extends Enum
{
    public const VERSION_1 = 1;

    protected static array $availableConst = [self::VERSION_1];
}