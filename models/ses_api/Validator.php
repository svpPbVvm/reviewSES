<?php

namespace models\ses_api;


use Exception;
use models\enum\ses_api\request\RequestParamsValidators;
use models\exception\ValidationException;

/**
 * Class Validator
 * @package models\ses_api
 */
class Validator
{
    /**
     * @param int $validatorType
     * @param $data
     * @return mixed
     * @throws ValidationException
     * @throws Exception
     */
    public static function validate(int $validatorType, $data)
    {
        switch ($validatorType) {
            case RequestParamsValidators::CHECK_EMAIL:
                $validated = self::checkEmail($data);
                break;
            case RequestParamsValidators::CHECK_PASSWORD:
                $validated = self::checkPassword($data);
                break;
            default:
                throw new ValidationException('unavailable validator');
        }

        return $validated;
    }

    /**
     * @param string $email
     * @return string
     * @throws Exception
     */
    public static function checkEmail(string $email): string
    {
        if (!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('invalid email');
        }

        return $email;
    }

    /**
     * @param string $password
     * @return string
     * @throws Exception
     */
    public static function checkPassword(string $password): string
    {
        $regExp = '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/';
        if ($password !== trim($password) || !preg_match($regExp, $password)) {
            throw new ValidationException('password is too simple, use a-Z, 0-9 and !@#$%^&*');
        }

        return $password;
    }
}
