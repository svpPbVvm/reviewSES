<?php

namespace app;


use Exception;
use models\enum\response\ResponseNeededParams;
use models\enum\ses_api\APIVersionsEnum;
use models\exception\CustomException;
use models\exception\NotFoundException;

/**
 * Class Router
 * @package app
 */
class Router
{
    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @var array
     */
    protected array $params = [];

    /**
     * Router constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        foreach($routes as $route => $params) {
            $this->addRoute($route, $params);
        }
    }

    /**
     * @param string $route
     * @param array $params
     */
    public function addRoute(
        string $route,
        array $params
    ): void
    {
        $this->routes[trim($route, '/')] = $params;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        try {
            $version = $_REQUEST['version'] ?: APIVersionsEnum::VERSION_1;
            if (APIVersionsEnum::isAvailableConst($version)) {
                if ($this->match()) {
                    $path = 'controllers\version_' . $version
                        . '\\' . ucfirst($this->params['controller']) . 'Controller';
                    if (class_exists($path)) {
                        $action = $this->params['action'];
                        if (method_exists($path, $action)) {
                            $controller = new $path();
                            $controller->$action();
                        } else {
                            throw new NotFoundException('not found');
                        }
                    } else {
                        throw new NotFoundException('not found');
                    }
                } else {
                    throw new NotFoundException('not found');
                }
            } else {
                throw new NotFoundException('not found');
            }
        } catch (CustomException $exception) {
            (new Response())
                ->setResponseCode($exception::RESPONSE_CODE)
                ->response([
                    ResponseNeededParams::SUCCESS => false,
                    ResponseNeededParams::ERROR => $exception->getMessage(),
                ]);
        } catch (Exception $exception) {
            (new Response())
                ->setResponseCode(500)
                ->response([
                    ResponseNeededParams::SUCCESS => false,
                    ResponseNeededParams::ERROR => 'server error',
                ]);
        }
    }

    /**
     * @return bool
     */
    private function match(): bool
    {
        $tempUrl = stristr($_SERVER['REQUEST_URI'], '?', true);
        $url = $tempUrl !== false ? $tempUrl : $_SERVER['REQUEST_URI'];
        $url = trim($url, '/');
        foreach ($this->routes as $route => $params) {
            if ($route === $url) {
                $this->params = $params;
                return true;
            }
        }

        return false;
    }
}
