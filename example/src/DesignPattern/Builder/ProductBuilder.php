<?php

namespace Adriatic\PHPAkademija\DesignPattern\Builder;

interface ProductBuilder
{
    public function withName(string $name) : self;
    public function withCategory(string $category) : self;
    public function withPrice(float $price) : self;
}
