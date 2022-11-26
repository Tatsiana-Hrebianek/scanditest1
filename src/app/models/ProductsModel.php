<?php

namespace app\models;

use mysqli;

class ProductsModel
{
    private $dbConnection;

    private function __construct()
    {
        $this->dbConnection = new mysqli('db', 'root', 'root', 'scandi');
        $this->dbConnection->query("SET NAMES 'utf8'");
    }

    public static function getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new self;
        }
        return $instance;
    }

    public function getDBConnection()
    {
        return $this->dbConnection;
    }

    public function getProducts()
    {
        $result = $this->getDBConnection()->query("SELECT * FROM `products`");
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;
        return $data;
    }

    public function addProduct($product)
    {
        $sku = $product->getSKU();
        $name = $product->getName();
        $price = $product->getPrice();
        $type = $product->getType();
        $size = 'NULL';
        $width = 'NULL';
        $length = 'NULL';
        $height = 'NULL';
        $weight = 'NULL';

        if (method_exists($product, 'getWeight')) {
            $weight = $product->getWeight();
        }
        if (method_exists($product, 'getLength')) {
            $length = $product->getLength();
        }
        if (method_exists($product, 'getHeight')) {
            $height = $product->getHeight();
        }
        if (method_exists($product, 'getWidth')) {
            $width = $product->getWidth();
        }
        if (method_exists($product, 'getSize')) {
            $size = $product->getSize();
        }

        $this->getDBConnection()->query("INSERT INTO `products` (`sku`, `name`, `price`, `size`, `height`, `width`, `length`, `weight`, `type`) VALUES ('$sku', '$name', '$price', $size, $height, $width, $length, $weight, '$type')");

    }

    public function deleteProducts()
    {
        $sku = $_POST['sku'];
        if (count($sku)) {
            $toString = "'" . implode("','", $sku) . "'";
            $this->getDBConnection()->query("DELETE FROM `products` WHERE `sku` IN($toString)");
        }
    }

    public function isProductExists($sku)
    {
        $data = $this->getDBConnection()->query("SELECT * FROM `products` WHERE `sku` = '$sku'");
        return (bool)$data->num_rows;
    }
}
