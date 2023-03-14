<?php

namespace App\Controllers;

use App\Models\ProductsModel;

/**
 *
 */
class DeleteProductsController
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
        $this->productsModel->deleteProducts();
        header('Location: /');
    }


}
