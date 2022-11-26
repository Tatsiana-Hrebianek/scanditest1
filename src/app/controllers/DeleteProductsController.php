<?php

namespace app\controllers;

use app\Controller;

class DeleteProductsController extends Controller
{
    public function action()
    {
        $this->getProductsModel()->deleteProducts();
        $showProducts = new ShowProductsController();
        $showProducts->action();
    }
}
