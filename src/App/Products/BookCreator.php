<?php

namespace App\Products;

class BookCreator extends Creator
{

    public function createProduct(): IProduct
    {
        return new Book();
    }
}