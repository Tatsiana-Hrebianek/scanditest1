<?php

namespace App\Products;

class DiscCreator extends Creator
{
    public function createProduct($arr): IProduct
    {
        return new Disc($arr);
    }
}