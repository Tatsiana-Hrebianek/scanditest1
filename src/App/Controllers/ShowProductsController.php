<?php

namespace App\Controllers;

use App\Component\TemplateComponent;

//use App\Controller;
use App\Models\ProductsModel;
use App\Products\Book;
use App\Products\Disc;
use App\Products\DiscCreator as DiscCreator;
use App\Products\BookCreator;
use App\Products\FurnitureCreator;

use App\Products\Furniture;

/**
 *
 */
class ShowProductsController
{
    /**
     * @return void
     */
    public function action(ProductsModel $ProductsModelInstance)
    {
        //$data = $this->getProductsModel()->getProducts();
        $data = $ProductsModelInstance->getProducts();


        foreach ($data as $elem) {
            $productClass = $elem['type'];
//            $productClassName = $productClass . 'Creator';
//            $prod = new $productClassName();
//            $product[] = $prod->createProduct($elem);

            if ($productClass === 'Disc') {
                $disc = new DiscCreator();
                $product[] = $disc->createProduct($elem);

                //$product[] = new Disc($elem);
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

        $template = new TemplateComponent();

        if (isset($product)) {
            echo $template->render('../App/templates/productList.php',
                [
                    'product' => $product,
                    'title' => 'Product List'
                ]
            );
        } else {

            echo $template->render('../App/templates/productList.php', ['title' => 'There are no products at this moment']);

        }
    }
}
