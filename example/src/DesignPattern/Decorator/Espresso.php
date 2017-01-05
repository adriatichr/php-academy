<?php

namespace Adriatic\PHPAkademija\DesignPattern\Decorator;

class Espresso extends Beverage
{
    public function getDescription() : string
    {
        return 'Espresso';
    }

    public function getCost() : float
    {
        return 6.49;
    }
}
