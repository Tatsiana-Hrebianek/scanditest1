<?php

namespace App\Controllers;

use App\Controller;

/**
 *
 */
class CheckSKUController extends Controller
{
    /**
     * @return void
     */
    public function action()
    {
        if ($this->getProductsModel()->isProductExists($_POST['sku'])) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
}


/**
 *
 */
//class CheckSKUController extends Controller
//{
//    /**
//     * @return void
//     */
//    public function action()
//    {
//        require_once __DIR__ . '/db.php';
//
//    }





