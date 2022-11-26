<?php
namespace app\products;
    class Book extends Product
    {
         private $weight;

        protected function setWeight($weight)
        {
            $this->weight=$weight;
        }

        public function getWeight()
        {
            return $this->weight;
        }
        public function __construct($arr) {
            parent::__construct($arr);
            $this->setWeight($arr['weight']);
        }
    }
