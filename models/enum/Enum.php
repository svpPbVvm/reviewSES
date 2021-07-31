<?php

namespace models\enum;


use ReflectionClass;

/**
 * Class Enum
 * @package models\enum
 */
abstract class Enum
{
    /**
     * @var array
     */
    protected static array $availableConst = [];

    /**
     * @return array
     */
    public static function getAvailableConst(): array
    {
        return static::$availableConst;
    }

    /**
     * @param $constValue
     * @param bool $strict
     * @return bool
     */
    public static function isAvailableConst($constValue, bool $strict = false): bool
    {
        return in_array($constValue, static::$availableConst, $strict);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getConstants(): array
    {
        $reflect = new ReflectionClass(get_called_class());
        return $reflect->getConstants();
    }

    /**
     * @param $constValue
     * @param bool $strict
     * @return bool
     * @throws \ReflectionException
     */
    public static function hasConst($constValue, bool $strict = false): bool
    {
        return in_array($constValue, self::getConstants());
    }
}
