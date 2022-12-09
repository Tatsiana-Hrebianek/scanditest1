<?php

namespace App\Products;

use Exception;

/**
 *
 */
class Disc implements IProduct
{
    private string $sku, $name, $type;
    private float $price;
    private $size;

    //private $property;

    public function __construct(array $arr)
    {
        $this->setName($arr['name']);
        $this->setSku($arr['sku']);
        $this->setPrice($arr['price']);
        $this->setType($arr['type']);
        $this->setProperty($arr['size']);
    }

    /**
     * @param string $sku
     * @return void
     */
    public function setSKU(string $sku)
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
     * @param string $name
     * @return void
     */
    public function setName(string $name)
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
     * @param float $price
     * @return void
     * @throws Exception
     */
    public function setPrice(float $price)
    {

        if ($price < 0) {
            throw new Exception("Price can't have negative value!" . date('Y:m:d H:i:s'));
        } else $this->price = $price;

    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type)
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

    public function setProperty($property)
    {
        $this->size = $property;
        //$this->property = $property['size'];
    }

    public function getProperty()
    {
        return $this->size;
    }
}













//class Disc extends Product
//{
//    /**
//     * @var int
//     */
//    private int $size;
//
//    /**
//     * @param $size
//     * @return void
//     */
//    protected function setSize($size)
//    {
//        $this->size = $size;
//    }
//
//    /**
//     * @return int
//     */
//    public function getSize(): int
//    {
//        return $this->size;
//    }
//
//    /**
//     * @param array $arr
//     */
//    public function __construct($arr)
//    {
//        parent::__construct($arr);
//        $this->setSize($arr['size']);
//    }
//}
