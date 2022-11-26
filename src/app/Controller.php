<?php
namespace app;
use app\models\ProductsModel;
    class Controller {
        public function getProductsModel()
        { 
            return ProductsModel::getInstance();       
        }  
    }
