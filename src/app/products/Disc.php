<?php

namespace app\products;
class Disc extends Product
{
    private $size;

    protected function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function __construct($arr)
    {
        parent::__construct($arr);
        $this->setSize($arr['size']);
    }
}
