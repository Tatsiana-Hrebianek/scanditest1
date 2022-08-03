<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');

    try{
        require '../app/bootstrap.php';
    } catch (Exception $e) {
        echo 'Autoload error';
    }
