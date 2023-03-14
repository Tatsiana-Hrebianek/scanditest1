<?php

namespace App\Products;

use Exception;

/**
 *
 */
abstract class Product
{
    /**
     * @var string
     */
    private string $name, $sku, $type;
    /**
     * @var float
     */
    private float $price;

    /**
     * @param $arr
     */
    public function __construct($arr)
    {
        $this->setName($arr['name']);
        $this->setSKU($arr['sku']);
        $this->setPrice($arr['price']);
        $this->setType($arr['type']);
    }

    /**
     * @param $sku
     * @return void
     */
    protected function setSKU($sku)
    {
        $reg = '{[A-Za-z]+[0-9]*}';

        if (strlen($sku) > 10) {
            throw new Exception("SKU should be maximum 10 characters");
        }
        if (!preg_match($reg, $sku)) {
            throw new Exception("SKU should be alpha number");
        } else {
            $this->sku = $sku;
        }


    }

    /**
     * @return string
     */
    public function getSKU(): string
    {
        return $this->sku;
    }

    /**
     * @param $name
     * @return void
     */
    protected function setName($name)
    {
        $reg = '{[A-Za-z]+[0-9]*}';

        if (strlen($name) > 10) {
            throw new Exception("Name should be maximum 10 characters");
        }
        if (!preg_match($reg, $name)) {
            throw new Exception("Name should be alpha number");
        } else {
            $this->name = $name;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $price
     * @return void
     */
    protected function setPrice($price)
    {
        $reg = "{[0-9]*\.[0-9]*}";

        if ($price < 1) {
            throw new Exception("Price can't be less than 1 dollar");
        }
        if ($price > 1000) {
            throw new Exception("Price should be maximum 1000$");
        }

        if (!preg_match($reg, $price)) {
            throw new Exception("Price should be float");
        } else {
            $this->price = $price;
        }


    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param $type
     * @return void
     */
    protected function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


}
