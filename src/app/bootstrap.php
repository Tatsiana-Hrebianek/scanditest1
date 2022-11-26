<?php

namespace app;

use app\Controller;
use app\controllers\ShowProductsController;
use app\models\ProductsModel;
use app\products\Product;
use app\products\Disc;
use app\products\Book;
use app\products\Furniture;
use app\FrontController;
use app\controllers\ShowProductFormController;
use app\controllers\ShowErrorPageController;

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

//use Exception;

$isDebugging = true;

if ($isDebugging) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('error_log', 'logs/error.log');
}

try {
    require_once '../vendor/autoload.php';
    (new FrontController)->route();

//    if ($_SERVER['REQUEST_URI'] === '/') {
//        require_once 'templates/productList.php';
//    }
//
//    if ($_SERVER['REQUEST_URI'] === '/addProduct') {
//        require_once 'templates/addProductForm.php';
//    }
//
//    if (($_SERVER['REQUEST_URI'] === '/') && (isset($_POST['sku'], $_POST['name'], $_POST['price']))) {
//        var_dump($_POST);
//    }
//
//    if (($_SERVER['REQUEST_URI'] !== '/') && ($_SERVER['REQUEST_URI'] !== '/addProduct')) {
//        throw new Exception("This address doesn't exists!");
//    }

} catch (Exception $e) {
    if ($isDebugging) {
        var_dump($e->getTrace());
    }
    echo 'Something went wrong!';
    error_log($e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/error.log');
}
//catch (Throwable $ex) {
//    $ex->getTrace();
//    $ex->getMessage();
//    echo "Error while executing programme" . $ex->getMessage();
//}
//catch (FileNotFoundException $exception) {
//
//}













