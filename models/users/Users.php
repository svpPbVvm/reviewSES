<?php

namespace models\users;


use models\enum\fileDB\UserFileFields;
use models\exception\ExistException;
use models\fileDB\FileManager;

/**
 * Class Users
 * @package models\users
 */
class Users
{
    /**
     * @var string
     */
    protected static string $filename = 'users';

    /**
     * @var string
     */
    protected static string $uniqTitle = 'email';

    /**
     * @return string
     */
    public static function getFilename(): string
    {
        return self::$filename;
    }

    /**
     * @return string
     */
    public static function getUniqTitle(): string
    {
        return self::$uniqTitle;
    }

    /**
     * @param User $user
     * @return bool
     * @throws \ReflectionException
     * @throws \Exception
     * @throws ExistException
     */
    public static function addUser(User $user): bool
    {
        FileManager::createFileIfNotExist(self::$filename, UserFileFields::getConstants());
        if (!self::getUser($user->getEmail())) {
            return FileManager::addRow(self::$filename, $user);
        } else {
            throw new ExistException('email exist');
        }
    }

    /**
     * @param string $email
     * @return array
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function getUser(string $email): array
    {
        FileManager::createFileIfNotExist(self::$filename, UserFileFields::getConstants());
        return FileManager::getRow(self::$filename, self::$uniqTitle, $email);
    }
}
