<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\CheckSKUController;
use App\Controllers\ShowProductsController;
use App\Container;

class Router
{
    private array $handlers;
    private $notFoundHandler;
    //let's create constants for POST and GET requests
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';


    //path is a string and handler that is callable or a function or a php-class that is going to be executed once router matches the path,
    //that we are going to access
    //in order to add handler we might need to add an array of handlers

    public function get(string $path, $handler): void
    {
        //and in order to add this path with handler in a handler array we are going to
        //add a key and a path because the same path can match different request methods like GET, POST

        $this->addHandler(self::METHOD_GET, $path, $handler);

    }

    public function post(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    //in order to avoid the repetetive code let's add an addHandler method

    private function addHandler(string $method, string $path, $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }


    public function route(Container $container)
    {

        //let's get url from the server
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        //this requestPath will be used in order to check the path of handler
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $handler['method'] === $method) {
                //if we find the correct path we can get a handler back
                $callback = $handler['handler'];
            }
        }

        if (is_string($callback)) {
            $parts = explode('::', $callback);
            if (is_array($parts)) {
                $className = array_shift($parts);

                //$handler = new $className();
                $handler = $container->get($className);

                //array_pop
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

        //and we can execute this callback with function:
//        return $callback;

        call_user_func_array($callback, [
            array_merge($_POST, $_GET),
        ]);


    }
}