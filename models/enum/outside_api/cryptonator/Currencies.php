<?php

namespace models\enum\outside_api\cryptonator;


use models\enum\Enum;

/**
 * Class Currencies
 * @package models\enum\outside_api\cryptonator
 */
class Currencies extends Enum
{
    public const BITCOIN = 'btc';
    public const ETHEREUM = 'eth';
    public const UKRAINIAN_HRYVNIA = 'uah';
    //public const CURRENCY = 'currency code';

    /**
     * @var array|string[]
     */
    protected static array $availableConst = [self::BITCOIN, self::UKRAINIAN_HRYVNIA];
}
