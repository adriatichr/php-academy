<?php

namespace Adriatic\PHPAkademija\DesignPattern\Decorator;

class WhippedCream extends CondimentDecorator
{
    public function getDescription() : string
    {
        return $this->beverage->getDescription() . ' sa šlagom';
    }

    public function getCost() : float
    {
        return $this->beverage->getCost() + 0.29;
    }
}
