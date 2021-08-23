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
        static::addRoute('GET', $route, $target);
    }

    public static function post(string $route, string $target)
    {
        static::addRoute('POST', $route, $target);
    }

    public static function patch(string $route, string $target)
    {
        static::addRoute('PATCH', $route, $target);
    }

    public static function delete(string $route, string $target)
    {
        static::addRoute('DELETE', $route, $target);
    }

    private static function addRoute(string $method, string $route, string $target)
    {
        static::$routes["{$method}|{$route}"] = CONTROLLERS_BASE_NAMESPACE . $target;
    }

    public static function dispatch(string $requestMethod, string $requestUri)
    {
        $route = preg_replace('/[0-9]+/', '{id}', $requestMethod . '|' . $requestUri);
        $route = strpos($route, '?') ? substr($route, 0, strpos($route, '?')) : $route;

        if (! isset(static::$routes[$route])) {
            http_response_code(404);
            view('errors/404.php');
            exit();
        }

        list($controllerClass, $controllerMethod) = explode('@', static::$routes[$route]);
        $controller = new $controllerClass();
        $controller->{$controllerMethod}();
    }
}
