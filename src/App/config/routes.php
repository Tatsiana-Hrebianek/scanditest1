<?php
declare(strict_types=1);

use App\Controllers\Router;

$router = new Router();
$router->addRoute('/', 'ShowProductsController', 'GET');
$router->addRoute('/', 'AddProductsController', 'POST');
$router->addRoute('/deleteProducts', 'DeleteProductsController', 'POST');
$router->addRoute('/addProduct', 'ShowProductFormController', 'GET');
$router->addRoute('/checkSKU', 'CheckSKUController', 'POST');

return $router;
