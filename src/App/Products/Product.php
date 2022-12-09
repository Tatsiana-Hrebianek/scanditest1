<?php

namespace App\Products;
/**
 *
 */
class Product
{
    /**
     * @var string
     */
    private string $name, $sku, $type;
    private float $price;

    /**
     * @param $sku
     * @return void
     */
    protected function setSKU($sku)
    {
        $this->sku = $sku;
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
        $this->name = $name;
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
        $this->price = $price;
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

    /**
     * @param array $arr
     */
    public function __construct($arr)
    {
        $this->setName($arr['name']);
        $this->setSku($arr['sku']);
        $this->setPrice($arr['price']);
        $this->setType($arr['type']);
    }
}
