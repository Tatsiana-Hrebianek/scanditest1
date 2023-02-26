<?php
declare(strict_types=1);

use App\Controllers\Router;

$router = new Router();
$router->get('/', ShowProductsController::class . '::action');
$router->post('/', AddProductsController::class . '::action');
$router->post('/deleteProducts', DeleteProductsController::class . '::action');
$router->get('/addProduct', ShowProductFormController::class . '::action');
$router->post('/checkSKU', CheckSKUController::class . '::action');
//    $routes->add('blog_show', '/blog/{slug}')
//        ->controller([BlogController::class, 'show'])
//        ->methods(['GET']);
return $router;
