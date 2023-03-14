<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Products\Book;
use App\Products\Disc;
use App\Products\Furniture;
use App\Controllers\Router;

use Exception;

/**
 *
 *
 */
class AddProductsController
{
    private $productsModel;

    public function __construct(ProductsModel $productsModel)
    {
        $this->productsModel = $productsModel;
    }

    /**
     * @return void
     */
    public function action()
    {
        /** @var string $productClass */
        $productClass = $_POST['type'];
        $product = [];
        if ($productClass === 'Disc') {
            $product = new Disc($_POST);
        }
        if ($productClass === 'Book') {
            $product = new Book($_POST);
        }
        if ($productClass === 'Furniture') {
            $product = new Furniture($_POST);
        }

        $this->productsModel->addProduct($product);

        header('Location: /');


    }
}

