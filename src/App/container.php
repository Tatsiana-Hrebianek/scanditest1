<?php

use Symfony\Component\DependencyInjection;
use App\Component\TemplateComponent;
use App\Controllers\AddProductsController;
use App\Controllers\CheckSKUController;
use App\Controllers\DeleteProductsController;
use App\Controllers\ShowErrorPageController;
use App\Controllers\ShowProductFormController;
use App\Controllers\ShowProductsController;
use App\Models\ProductsModel;
use App\Products\Book;
use App\Products\Disc;
use App\Products\Furniture;
use App\Products\Product;
use App\FrontController;

$containerBuilder = new DependencyInjection\ContainerBuilder();

$containerBuilder->register('TemplateComponent', TemplateComponent::class);
$containerBuilder->setParameter('dsn', 'mysql:host=db;dbname=scandi;charset=utf8mb4');
$containerBuilder->setParameter('name', 'root');
$containerBuilder->setParameter('password', 'root');
$containerBuilder->register('connection', PDO::class)
    ->setArguments([
        '%dsn%', '%name%', '%password%'
    ]);
$containerBuilder->register('ProductsModel', ProductsModel::class)
    ->addArgument(new DependencyInjection\Reference('connection'));
$containerBuilder->register('AddProductsController', AddProductsController::class)
    ->addArgument(new DependencyInjection\Reference('ProductsModel'));

$containerBuilder->register('ShowProductsController', ShowProductsController::class)
    ->addArgument(new DependencyInjection\Reference('ProductsModel'));

$containerBuilder->register('ShowProductFormController', ShowProductFormController::class);

$containerBuilder->register('DeleteProductsController', DeleteProductsController::class)
    ->addArgument(new DependencyInjection\Reference('ProductsModel'));

$containerBuilder->register('CheckSKUController', CheckSKUController::class)
    ->addArgument(new DependencyInjection\Reference('ProductsModel'));

$containerBuilder->register('ShowErrorPageController', ShowErrorPageController::class);


return $containerBuilder;