<?php

namespace Adriatic\PHPAkademija\DesignPattern\Decorator;

class Decaf extends Beverage
{
    public function getDescription() : string
    {
        return 'Kava bez kofeina';
    }

    public function getCost() : float
    {
        return 6.99;
    }
}
