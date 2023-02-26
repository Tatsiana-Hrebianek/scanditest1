<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 *
 */
class Router
{
    /**
     * @var array
     */
    private array $routes;
    /**
     * @var
     */
    private $notFoundHandler;

    //path is a string and handler that is callable or a function or a php-class that is going to be executed once router matches the path,
    //that we are going to access
    //in order to add handler we might need to add an array of handlers

    /**
     * @param string $path
     * @param $handler
     * @param $method
     * @return void
     */
    public function addRoute(string $path, $handler, $method)
    {
        $this->routes[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    //???

    /**
     * @param $handler
     * @return void
     */
    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }


    /**
     * @param $container
     * @return void
     */
    public function route($container)
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach ($this->routes as $route) {
            if ($route['path'] === $requestPath && $route['method'] === $method) {
                //if we find the correct path we can get a handler back
                $handler = $container->get($route['handler']);
                $callback = [$handler, 'action'];

            }
        }

        if (is_string($callback)) {
            $parts = explode('::', $callback);
            if (is_array($parts)) {
                $className = array_shift($parts);
                $className = explode('\\', $className);
                $className = array_pop($className);

                $handler = $container->get($className);

                $method = array_shift($parts);
                $callback = [$handler, $method];

            }
        }

        if (!$callback) {
            header("HTTP/1.0 404 Not Found");
            if (!empty($this->notFoundHandler)) {
                $callback = $this->notFoundHandler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_POST, $_GET),
        ]);

    }
}