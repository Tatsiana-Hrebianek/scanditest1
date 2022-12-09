<?php

namespace App\Models;

use App\Products\IProduct;
use PDO;
use Exception;

/**
 *
 */
class ProductsModel
{
    public object $dbConnection;

    public function __construct(PDO $dbconnection)
    {
        $this->dbConnection = $dbconnection;
    }

//    private function __construct(PDO $dbconnection)
//    {
//        $this->dbConnection = $dbconnection;
//    }

    /**
     * @return ProductsModel|mixed
     */
//    public static function getInstance()
//    {
//        static $instance;
//        if (!isset($instance)) {
//            $options = [
//                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
//                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
//                \PDO::ATTR_EMULATE_PREPARES => false,
//            ];
//            $instance = new self(new PDO("mysql:host=db;dbname=scandi;charset=utf8mb4",
//                'root', 'root', $options));
//        }
//        return $instance;
//    }

    /**
     * @return PDO
     */
    public function getDBConnection()
    {
        return $this->dbConnection;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        $query = "SELECT * FROM `products`";
        $sth = $this->getDBConnection()->prepare($query);
        $sth->execute();
        return $sth->fetchAll();
    }

    /**
     * @param IProduct $product
     * @return void
     * @throws Exception
     */
    public function addProduct(IProduct $product)
    {
        if (empty($this->isProductExists($product->getSKU()))) {
            $sku = $product->getSKU();

        } else {
            throw new Exception("This SKU already exists! ProductsModel");
        }

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

        $this->getDBConnection()->prepare("INSERT INTO `products` ( `sku`, `name`, `price`, `size`, `height`, `width`, `length`, `weight`, `type`)
VALUES ('$sku', '$name', '$price', $size, $height, $width, $length, $weight, '$type')")->execute();
    }

    /**
     * @return void
     */
    public function deleteProducts()
    {
        $sku = $_POST['sku'];
        if (count($sku)) {
            $toString = "'" . implode("','", $sku) . "'";
            $this->getDBConnection()->prepare("DELETE FROM `products` WHERE `sku` IN($toString)")->execute();
        }
    }

    /**
     * @param $sku
     * @return array
     */
    public function isProductExists($sku): array
    {
        $query = "SELECT * FROM `products` WHERE `sku` = '$sku'";
        $sth = $this->getDBConnection()->prepare($query);
        $sth->execute();
        return $sth->fetchAll();
    }
}
