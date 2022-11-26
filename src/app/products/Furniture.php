<?php
namespace app\products;
    class Furniture extends Product
    {
        private $height, $length, $width;

        protected function setHeight($height)
        {
            $this->height = $height;
        }

        public function getHeight()
        {
            return $this->height;
        }

        protected function setLength($length)
        {
            $this->length = $length;
        }

        public function getLength()
        {
            return $this->length;
        }

        protected function setWidth($width)
        {
            $this->width = $width;
        }

        public function getWidth()
        {
            return $this->width;
        }

        public function __construct($arr)
        {
            parent::__construct($arr);
            $this->setLength($arr['length']);
            $this->setHeight($arr['height']);
            $this->setWidth($arr['width']);
        }
    }
