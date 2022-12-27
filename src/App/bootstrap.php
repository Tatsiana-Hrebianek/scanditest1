<?php

namespace App;

use App\Controllers\AddProductsController;
use App\Controllers\CheckSKUController;
use App\Controllers\DeleteProductsController;
use App\Controllers\ShowProductFormController;
use App\Controllers\ShowProductsController;
use App\Controllers\Router;
use Exception;

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);


$isDebugging = true;

if ($isDebugging) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

try {
    $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];

    require_once __DIR__ . '/config/config.php';
    require_once '../vendor/autoload.php';
    $dependencies = require_once __DIR__ . '/config/dependencies.php';

    $container = new Container($dependencies);
    $router = new Router();

    $router->get('/', ShowProductsController::class . '::action');
    $router->post('/', AddProductsController::class . '::action');
    $router->post('/deleteProducts', DeleteProductsController::class . '::action');
    $router->get('/addProduct', ShowProductFormController::class . '::action');
    $router->post('/checkSKU', CheckSKUController::class . '::action');

//    $router->addNotFoundHandler(function () {
//        echo 'Not Found';
//    });

//    $router->post('/', function (array $params) {
//        $container = new Container();
//        if (isset($params['sku'])) {
//            $container->get(DeleteProductsController::class)->action();
//        }
//
//        if (!count($params)) {
//            $container->get(ShowProductsController::class)->action();
//        }
//
//        if (isset($params['sku'], $params['name'], $params['price'])) {
//            $h = $container->get(AddProductsController::class);
//            $h->action();
//        }
//
//
//    });


    //once we define our routs we have a method run()
    //method run will look for handler that has to be executed as for given route
    $router->route($container);


} catch (Exception $e) {
    if ($isDebugging) {
        echo $e->getMessage();
        var_dump($e->getTrace());
    }
    echo 'Something went wrong!';
    error_log($e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/error.log');
}













