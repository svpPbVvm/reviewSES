<?php

namespace app;


/**
 * Class Application
 * @package app
 */
class Application
{
    /**
     * @var array
     */
    private static array $routes = [];

    /**
     * @throws \Exception
     */
    final public function start(): void
    {
        self::$routes = require 'config/routes.php';
        (new Router(self::$routes))->run();
    }

    /**
     * @return array
     */
    public static function getRouts(): array
    {
        return self::$routes;
    }

    /**
     * @return bool
     */
    public static function isLogged(): bool
    {
        return (bool)$_SESSION['user'];
    }
}