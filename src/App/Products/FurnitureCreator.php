<?php

namespace App\Products;

class FurnitureCreator extends Creator
{
    public function createProduct(): IProduct
    {
        return new Furniture();
    }
}