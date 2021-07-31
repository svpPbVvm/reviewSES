<?php

namespace models\enum\fileDB;


use models\enum\Enum;

/**
 * Class UserFileFields
 * @package models\enum\fileDB
 */
class UserFileFields extends Enum
{
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const CREATED_AT = 'created_at';
}
