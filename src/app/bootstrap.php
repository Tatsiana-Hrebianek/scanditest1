<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

$isDebugging = true;

if($isDebugging) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// try{
    if ($_SERVER['REQUEST_URI'] === '/'){
      require_once 'templates/productList.php';  
    }
    
// } catch (Exception $e) {
//     echo 'Something went wrong!';
// }

    if($_SERVER['REQUEST_URI'] === '/addProduct'){
        require_once 'templates/addProductForm.php';
    }

