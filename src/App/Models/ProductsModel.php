<?php

namespace App\Models;

use App\Products\Product;
use PDO;
use Exception;

/**
 *
 */
class ProductsModel
{
    private object $dbConnection;

    public function __construct(PDO $dbconnection)

    {
        $this->dbConnection = $dbconnection;
    }

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
     * @param Product $product
     * @return void
     * @throws Exception
     */
    public function addProduct(Product $product)
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

        $this->getDBConnection()->prepare("INSERT INTO `products` ( `sku`, `name`, `price`, `size`, `height`, `width`,
                        `length`, `weight`, `type`) VALUES ('$sku', '$name', '$price', $size, $height, $width, $length, $weight, '$type')")->execute();


//        $this->getDBConnection()->prepare("INSERT INTO `products` ( `sku`, `name`, `price`, `size`, `height`, `width`, `length`, `weight`, `type`)
//VALUES (':sku, ':name', ':price', :size, :height, :width, :length, :weight, ':type')")->execute();


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

    /**
     *
     * @return void
     */
    public function checkSKU()
    {
        $inp = $_POST['param'];
        $value = $_POST[$inp];
        $error = $_POST['error'];

        $query = "SELECT * FROM products WHERE sku='$value'";
        $sth = $this->getDBConnection()->prepare($query);
        $sth->execute();
        $row = $sth->fetch();

        if (!empty($value)) {

            if ($value === $row["$inp"]) {
                $mes = ['error1' => "$error"];
            } else {
                $mes = ['error1' => "ok"];
            }
            echo json_encode($mes);

        } else {
            $mes = ['error1' => "Please enter $inp!"];
            echo json_encode($mes);

        }
    }


}
