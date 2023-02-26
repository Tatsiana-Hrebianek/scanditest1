<?php

declare(strict_types=1);

namespace App;

//use Symfony\Component\Routing\Generator\UrlGenerator;
//use Symfony\Component\Routing\Matcher\UrlMatcher;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\Route;
//use Symfony\Component\Routing\RouteCollection;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use App\Controllers\ShowProductsController;

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
    $routes = __DIR__ . '/app.php';


    $container = include __DIR__ . '/container.php';
    $router = new Router();

    $router->get('/', ShowProductsController::class . '::action');
    $router->post('/', AddProductsController::class . '::action');
    $router->post('/deleteProducts', DeleteProductsController::class . '::action');
    $router->get('/addProduct', ShowProductFormController::class . '::action');
    $router->post('/checkSKU', CheckSKUController::class . '::action');

    $router->route($container);

} catch (Exception $e) {
    if ($isDebugging) {
        echo $e->getMessage();
        var_dump($e->getTrace());
    }
    echo 'Something went wrong!';
    error_log($e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/error.log');
}













