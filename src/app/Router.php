<?php

namespace App;

class Router
{
    /**
     * @var array<string, string>
     */
    private static array $routes = [];

    /**
     * @return array<string, string>
     */
    public static function getRoutes(): array
    {
        return static::$routes;
    }

    public static function get(string $route, string $target)
    {
        static::addRoute('GET', $route, CONTROLLERS_PATH . $target);
    }

    public static function post(string $route, string $target)
    {
        static::addRoute('POST', $route, CONTROLLERS_PATH . $target);
    }

    public static function patch(string $route, string $target)
    {
        static::addRoute('PATCH', $route, CONTROLLERS_PATH . $target);
    }

    public static function delete(string $route, string $target)
    {
        static::addRoute('DELETE', $route, CONTROLLERS_PATH . $target);
    }

    private static function addRoute(string $method, string $route, string $target)
    {
        static::$routes["{$method}|{$route}"] = $target;
    }

    public static function dispatch(string $requestMethod, string $requestUri)
    {
        $route = $requestMethod . '|' . $requestUri;

        if (! isset(static::$routes[$route])) {
            echo '404';
            exit();
        }

        list($controllerClass, $controllerMethod) = explode('@', static::$routes[$route]);
        $controller = new $controllerClass();
        $controller->{$controllerMethod}();
        exit();
    }
}
