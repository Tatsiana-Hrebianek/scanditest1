<?php

namespace App\Products;

abstract class Creator
{
    abstract public function createProduct($arr): IProduct;

    public function UseProduct()
    {
        //call a factory method to get a product Instance
        $product = $this->createProduct();
        //then work with the object

    }
}