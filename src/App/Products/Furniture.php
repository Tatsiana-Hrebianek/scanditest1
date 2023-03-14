<?php

namespace App\Products;

use Exception;

/**
 *
 */
class Furniture implements IProduct
{
    private string $sku, $name, $type;
    private float $price;
    private $width, $height, $length;
    private array $property;

    public function __construct(array $arr)
    {
        $this->setName($arr['name']);
        $this->setSku($arr['sku']);
        $this->setPrice($arr['price']);
        $this->setType($arr['type']);
        $this->setProperty($arr['height']);
        $this->setProperty($arr['width']);
        $this->setProperty($arr['length']);
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
        if ($property == 'width') {
            $this->width = $property;
        }
        if ($property == 'length') {
            $this->length = $property;
        }
        if ($property == 'height') {
            $this->height = $property;
        }
    }

    public function getProperty()
    {
//
        return $this->height;
    }


}









//class Furniture extends Product
//{
//    /**
//     * @var float
//     */
//    private float $height, $length, $width;
//
//    /**
//     * @param $height
//     * @return void
//     */
//    protected function setHeight($height)
//    {
//        $this->height = $height;
//    }
//
//    /**
//     * @return float
//     */
//    public function getHeight(): float
//    {
//        return $this->height;
//    }
//
//    /**
//     * @param $length
//     * @return void
//     */
//    protected function setLength($length)
//    {
//        $this->length = $length;
//    }
//
//    /**
//     * @return float
//     */
//    public function getLength(): float
//    {
//        return $this->length;
//    }
//
//    /**
//     * @param $width
//     * @return void
//     */
//    protected function setWidth($width)
//    {
//        $this->width = $width;
//    }
//
//    /**
//     * @return float
//     */
//    public function getWidth(): float
//    {
//        return $this->width;
//    }
//
//    /**
//     * @param array $arr
//     */
//    public function __construct($arr)
//    {
//        parent::__construct($arr);
//        $this->setLength($arr['length']);
//        $this->setHeight($arr['height']);
//        $this->setWidth($arr['width']);
//    }
//}
