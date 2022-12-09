<?php

namespace App;

use App\Models\ProductsModel;
use PDO;
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
    $ProductsModelInstance = new ProductsModel(new PDO(DSN, NAME, PASSWORD, $options));
    (new FrontController)->route($ProductsModelInstance);
} catch (Exception $e) {
    if ($isDebugging) {
        echo $e->getMessage();
        var_dump($e->getTrace());
    }
    echo 'Something went wrong!';
    error_log($e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/error.log');
}













