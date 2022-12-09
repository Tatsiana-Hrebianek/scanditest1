<?php

namespace App\Controllers;

use App\Models\ProductsModel;

/**
 *
 */
class DeleteProductsController
{
    /**
     * @return void
     */
    public function action(ProductsModel $ProductsModelInstance)
    {
        //$this->getProductsModel()->deleteProducts();

        $ProductsModelInstance->deleteProducts();
        $showProducts = new ShowProductsController();
        $showProducts->action($ProductsModelInstance);
    }
}
