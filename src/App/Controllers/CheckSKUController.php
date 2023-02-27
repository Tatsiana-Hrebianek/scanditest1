<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Controllers\Router;
use PDO;

class CheckSKUController
{
    private $productsModel;

    public function __constructor(ProductsModel $productsModel)
    {
        $this->productsModel = $productsModel;
    }

    public function action()
    {
        header('Content-Type: application/json');
        $inp = $_POST['param'];
        $value = $_POST[$inp];
        $error = $_POST['error'];
//??? is DI supported for XHR requests
        $dbconnection = new PDO(DSN, NAME, PASSWORD);
        $row = (new ProductsModel($dbconnection))->checkSKU($value);
//        $row = $this->productsModel->checkSKU($value);

        if ($value === $row["$inp"]) {
            $mes = ['error1' => "$error"];
        } else {
            $mes = ['error1' => "ok"];
        }
        echo json_encode($mes);

    }
}

















//namespace App\Controllers;
////header('Content-Type: application/json');
//
//use App\Models\ProductsModel;
//
///**
// *
// */
//class CheckSKUController
//{
//    private object $productsModel;
//
//    public function __constructor(ProductsModel $productsModel)
//    {
//        $this->productsModel = $productsModel;
//    }


/**
 * @return void
 */
//    public function action()
//    {
//        if ($this->getProductsModel()->isProductExists($_POST['sku'])) {
//            echo 'false';
//        } else {
//            echo 'true';
//        }
//    }
//}

//    public function action()
//    {
//        $inp = $_POST['param'];
//        $value = $_POST[$inp];
//        $error = $_POST['error'];
//        $query = "SELECT * FROM products WHERE sku='$value'";
//        $sth = $this->productsModel->prepare($query);
//        $sth->execute();
//        $row = $sth->fetch();
//
//        if (!empty($value)) {
//
//            if ($value === $row["$inp"]) {
//                $mes = ['error1' => "$error"];
//            } else {
//                $mes = ['error1' => "ok"];
//            }
//            echo json_encode($mes);
//
//        } else {
//            $mes = ['error1' => "Please enter $inp!"];
//            echo json_encode($mes);
//        }
//
//
////        if ($this->productsModel->isProductExists($_POST['sku'])) {
////
////
////            echo 'false';
////        } else {
////            echo 'true';
////        }
//    }

//    public function action()
//    {
//        require_once __DIR__ . '/db.php';
//
//    }
//}


/**
 *
 */
//class CheckSKUController extends Controller
//{
//    /**
//     * @return void
//     */






