<?php

namespace app\controllers;

use app\models\ProductsModel;

use app\products\Product;
use app\products\Disc;
use app\products\Book;
use app\products\Furniture;
use app\Controller;

class ShowProductsController extends Controller
{
    public function action()
    {
        $data = $this->getProductsModel()->getProducts();
        
        foreach ($data as $elem) {
            $productClass = $elem['type'];
            if ($productClass === 'Disc') {
                $product[] = new Disc($elem);
            }
            if ($productClass === 'Book') {
                $product[] = new Book($elem);
            }
            if ($productClass === 'Furniture') {
                $product[] = new Furniture($elem);
            }
            //Doesn't work!!!
            //$product[] = new $productClass($elem);
        }

        $template = new TemplateController();

        if (isset($product)) {
            echo $template->render('../app/templates/productList.php',
                [
                    'product' => $product,
                    'title' => 'Product List'
                ]
            );
        } else {

            echo $template->render('../app/templates/productList.php', ['title' => 'There are no products at this moment']);

        }
    }
}
