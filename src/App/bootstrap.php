<?php
declare(strict_types=1);

namespace App;

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
    
    $container = include __DIR__ . '/container.php';
    $router = include __DIR__ . '/config/routes.php';

    $router->route($container);

} catch (Exception $e) {
    if ($isDebugging) {
        echo $e->getMessage();
        var_dump($e->getTrace());
    }
    echo 'Something went wrong!';
    error_log($e->getMessage() . PHP_EOL, 3, __DIR__ . '/logs/error.log');
}













