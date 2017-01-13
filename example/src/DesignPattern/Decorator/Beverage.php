<?php

namespace Adriatic\PHPAkademija\DesignPattern\Decorator;

abstract class Beverage
{
    abstract public function getDescription() : string;

    abstract public function getCost() : float;
}
