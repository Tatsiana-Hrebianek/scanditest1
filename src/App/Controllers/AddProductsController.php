<?php

namespace App\Controllers;

//use App\Controller;
use App\Products\Book;
use App\Products\Disc;
use App\Products\DiscCreator;
use App\Products\Furniture;
use Exception;

/**
 *
 *
 */
class AddProductsController
{
    /**
     * @return void
     */
    public function action($ProductsModelInstance)
    {
        /** @var string $productClass */
        $productClass = $_POST['type'];
        $product = [];
        if ($productClass === 'Disc') {
            $product = new DiscCreator();
            $product = $product->createProduct($_POST);
            //$product = new Disc($_POST);
        }
        if ($productClass === 'Book') {
            $product = new Book($_POST);
        }
        if ($productClass === 'Furniture') {
            $product = new Furniture($_POST);
        }

        //var_dump($product);
        //Doesn't find class!!!

        //$product = new $productClass($_POST);

        //var_dump($this->getProductsModel()->isProductExists($_POST['sku']));


        //$this->getProductsModel()->addProduct($product);
        $ProductsModelInstance->addProduct($product);

        $showProducts = new ShowProductsController();
        $showProducts->action($ProductsModelInstance);

    }
}

