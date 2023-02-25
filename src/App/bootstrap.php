<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use App\Controllers\AddProductsController;
use App\Controllers\CheckSKUController;
use App\Controllers\DeleteProductsController;
use App\Controllers\ShowProductFormController;
use App\Controllers\ShowProductsController;
use App\Controllers\Router;
use Exception;

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');


$isDebugging = true;

if ($isDebugging) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

try {

    require_once '../vendor/autoload.php';
    require_once __DIR__ . '/config/config.php';
    $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $container = include __DIR__ . '/container.php';


    (new FrontController)->route($container);
//     $dependencies = require_once __DIR__ . '/config/dependencies.php';

//     $container = new Container($dependencies);

//
//     $request = Request::createFromGlobals();
//     $routes = include __DIR__.'/config/routes.php';
//     $context = new RequestContext();
//
//
//
//
//     $context->fromRequest($request);
//     $matcher = new UrlMatcher($routes, $context);


    //  try {
//    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
//    ob_start();
//    include sprintf(__DIR__ . '/templates/%s.php', $_route);
//
//    $response = new Response(ob_get_clean());
    //  } catch (Routing\Exception\ResourceNotFoundException $exception) {
    //     $response = new Response('Not Found', 404);
    //  } catch (Exception $exception){
    //     $response = new Response('An error occurred', 500);
    //  }  

//    $response->send();


    // $route = new Route('/', ['_controller' => ShowProductsController::class]);


    // $routes = new RouteCollection();
    // $routes->add('ProductList_page', $route);

    // $context = new RequestContext();

    // //Routing can match routes with incoming requests
    // $matcher = new UrlMatcher($routes, $context);
    // $parameters = $matcher->match('/');


    // $router = new Router();

    // $router->get('/', ShowProductsController::class . '::action');

    // $router->get('/', ShowProductsController::class . '::action');
    // $router->post('/', AddProductsController::class . '::action');
    // $router->post('/deleteProducts', DeleteProductsController::class . '::action');
    // $router->get('/addProduct', ShowProductFormController::class . '::action');
    // $router->post('/checkSKU', CheckSKUController::class . '::action');


    // // //once we define our routs we have a method run()
    // // //method run will look for handler that has to be executed as for given route
    // $router->route($container);


} catch (Exception $e) {
    if ($isDebugging) {
        echo $e->getMessage();
        var_dump($e->getTrace());
    }
    echo 'Something went wrong!';
    error_log($e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/error.log');
}













