<?php

namespace models\enum\ses_api;


use models\enum\Enum;

/**
 * Class NeededRequestParams
 * @package models\enum\ses_api
 */
class NeededRequestParams extends Enum
{
    /**
     * @var array
     */
    protected static array $paramsValidatorByTitleList = [];

    /**
     * @return array
     */
    public static function getParamsValidatorByTitleList(): array
    {
        return static::$paramsValidatorByTitleList;
    }
}
