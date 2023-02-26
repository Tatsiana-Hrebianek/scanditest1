<?php
declare(strict_types=1);

use App\Controllers\Router;

$router = new Router();
$router->addRoute('/', ShowProductsController::class, 'GET');
$router->addRoute('/', ShowProductsController::class, 'GET');
$router->addRoute('/', AddProductsController::class, 'POST');
$router->addRoute('/deleteProducts', DeleteProductsController::class, 'POST');
$router->addRoute('/addProduct', ShowProductFormController::class, 'GET');
$router->addRoute('/checkSKU', CheckSKUController::class, 'POST');

return $router;
