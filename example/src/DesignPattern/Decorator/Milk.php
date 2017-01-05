<?php

namespace Adriatic\PHPAkademija\DesignPattern\Decorator;

class Milk extends CondimentDecorator
{
    public function getDescription() : string
    {
        return $this->beverage->getDescription() . ', mlijeko';
    }

    public function getCost() : float
    {
        return $this->beverage->getCost() + 0.49;
    }
}
