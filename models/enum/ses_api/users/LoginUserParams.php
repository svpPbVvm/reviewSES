<?php

namespace models\enum\ses_api\users;


use models\enum\ses_api\NeededRequestParams;
use models\enum\ses_api\request\RequestParamsValidators;

/**
 * Class LoginUserParams
 * @package models\enum\ses_api\users
 */
class LoginUserParams extends NeededRequestParams
{
    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    /**
     * @var array
     */
    protected static array $paramsValidatorByTitleList = [
        self::EMAIL => RequestParamsValidators::CHECK_EMAIL,
    ];
}
