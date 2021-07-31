<?php

namespace models\enum\outside_api\cryptonator;


use models\enum\Enum;

/**
 * Class Methods
 * @package models\enum\outside_api\cryptonator
 */
class Methods extends Enum
{
    public const SIMPLE_TICKER = 'ticker';
    public const COMPLETE_TICKER = 'full';

    /**
     * @var array|string[]
     */
    protected static array $availableConst = [self::SIMPLE_TICKER];
}