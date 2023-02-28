<?php

declare(strict_types=1);

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
        $stm = $this->getDBConnection()->prepare("INSERT INTO products ( sku, name, price, size, height, width, length, weight, type)
VALUES (:sku, :name, :price, :size, :height, :width, :length, :weight, :type)");

        $stm->bindParam(':sku', $sku);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':price', $price);
        $stm->bindParam(':size', $size);
        $stm->bindParam(':height', $height);
        $stm->bindParam(':width', $width);
        $stm->bindParam(':length', $length);
        $stm->bindParam(':weight', $weight);
        $stm->bindParam(':type', $type);

        if (empty($this->isProductExists($product->getSKU()))) {
            $sku = $product->getSKU();

        } else {
            throw new Exception("This SKU already exists! ProductsModel");
        }

        $name = $product->getName();
        $price = $product->getPrice();
        $type = $product->getType();
        $size = 0;
        //???
//        $size = 'NULL';
        $width = 0;
        $length = 0;
        $height = 0;
        $weight = 0;

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

        $stm->execute();
    }

    /**
     * @return void
     */
    public function deleteProducts()
    {
        $skus = $_POST['sku'];
        if (count($skus)) {
            $placeholders = array_fill(0, count($skus), '?');
            $toString = implode(',', $placeholders);
            $stmt = $this->getDBConnection()->prepare("DELETE FROM products WHERE sku IN (" . $toString . ")");
            $i = 1;
            foreach ($skus as $sku) {
                $stmt->bindValue($i++, $sku);
            }
            $stmt->execute();
        }
    }

    /**
     * @param $sku
     * @return array
     */
    public function isProductExists($sku): array
    {
        $stmt = $this->getDBConnection()->prepare("SELECT * FROM products WHERE sku = :sku");
        $stmt->bindParam(':sku', $sku);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    /**
     * @param $value
     * @return mixed
     */
    public function checkSKU($value): string
    {
        $stmt = $this->getDBConnection()->prepare("SELECT * FROM products WHERE sku = :sku");
        $stmt->bindParam(':sku', $value);
        $stmt->execute();
        return $stmt->fetch();
    }
}
