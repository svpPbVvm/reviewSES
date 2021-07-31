<?php

namespace models\enum\ses_api\users;


use models\enum\ses_api\NeededRequestParams;
use models\enum\ses_api\request\RequestParamsValidators;

/**
 * Class CreateUserParams
 * @package models\enum\ses_api\users
 */
class CreateUserParams extends NeededRequestParams
{
    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    /**
     * @var array
     */
    protected static array $paramsValidatorByTitleList = [
        self::EMAIL => RequestParamsValidators::CHECK_EMAIL,
        self::PASSWORD => RequestParamsValidators::CHECK_PASSWORD,
    ];
}