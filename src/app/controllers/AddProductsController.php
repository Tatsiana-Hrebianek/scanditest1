<?php

namespace app\controllers;

use app\Controller;
use app\products\Book;
use app\products\Disc;
use app\products\Furniture;

class AddProductsController extends Controller
{
    public function action()
    {
        $product;

        $productClass = $_POST['type'];
        if ($productClass === 'Disc') {
            $product = new Disc($_POST);
        }
        if ($productClass === 'Book') {
            $product = new Book($_POST);
        }
        if ($productClass === 'Furniture') {
            $product = new Furniture($_POST);
        }
        //Doesn't find class!!!
        //$product = new $productClass($_POST);
        $this->getProductsModel()->addProduct($product);
        $showProducts = new ShowProductsController();
        $showProducts->action();

    }
}


