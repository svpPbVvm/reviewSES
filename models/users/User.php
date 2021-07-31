<?php

namespace models\users;


/**
 * Class User
 * @package models\users
 */
class User
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
     * User constructor.
     * @param $email
     * @param $password
     */
    public function __construct(
        $email,
        $password
    )
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getEmail() . ',' . $this->getPassword() . ',' . time();
    }
}
