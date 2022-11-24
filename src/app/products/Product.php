<?php

namespace app\products;
class Product
{
    private $name, $sku, $price, $type;

    protected function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    protected function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    protected function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function __construct($arr)
    {
        $this->setName($arr['name']);
        $this->setSku($arr['sku']);
        $this->setPrice($arr['price']);
        $this->setType($arr['type']);
    }
}
