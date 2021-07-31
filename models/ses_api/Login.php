<?php

namespace models\ses_api;


use models\enum\ses_api\users\LoginUserParams;
use models\exception\LoginException;
use models\users\Users;

/**
 * Class Login
 * @package models\ses_api
 */
class Login
{
    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected string $password;

    /**
     * Login constructor.
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $email,
        string $password
    )
    {
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * @throws LoginException
     * @throws \ReflectionException
     */
    public function login()
    {
        $userData = Users::getUser($this->email);
        if ($userData && $this->password == $userData[LoginUserParams::PASSWORD]) {
            $_SESSION['user'] = $userData;
        } else {
            throw new LoginException('login exception: incorrect data');
        }
    }
}
