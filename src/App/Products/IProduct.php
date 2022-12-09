<?php

namespace App\Products;

interface IProduct
{
    function __construct(array $arr);


    function setSKU(string $sku);

    function getSKU(): string;

    function setName(string $name);

    function getName(): string;

    function setPrice(float $price);

    function getPrice(): float;

    function setProperty($property);

    function getProperty();

    function setType(string $type);

    function getType(): string;
}