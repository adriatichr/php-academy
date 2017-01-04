<?php

namespace Adriatic\PHPAkademija\DesignPattern\Builder;

class Product
{
    private $name;
    private $category;
    private $price;

    private function __construct(ProductBuilder $builder)
    {
        $this->name = $builder->name;
        $this->category = $builder->category;
        $this->price = $builder->price;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function category() : string
    {
        return $this->category;
    }

    public function price() : float
    {
        return $this->price;
    }

    public static function createBuilder() : ProductBuilder
    {
        $createProduct = function(ProductBuilder $builder) { return new self($builder); };

        return new class($createProduct) implements ProductBuilder {
            public $name;
            public $category;
            public $price;

            private $createProduct;

            public function __construct(callable $createProduct)
            {
                $this->createProduct = $createProduct;
            }

            public function withName(string $name) : ProductBuilder
            {
                $this->name = $name;
                return $this;
            }

            public function withCategory(string $category) : ProductBuilder
            {
                $this->category = $category;
                return $this;
            }

            public function withPrice(float $price) : ProductBuilder
            {
                $this->price = $price;
                return $this;
            }

            public function getProduct()
            {
                return ($this->createProduct)($this);
            }
        };
    }
}
