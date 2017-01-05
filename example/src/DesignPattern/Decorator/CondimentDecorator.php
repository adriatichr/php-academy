<?php

namespace Adriatic\PHPAkademija\DesignPattern\Decorator;

abstract class CondimentDecorator extends Beverage
{
    protected $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }
}
