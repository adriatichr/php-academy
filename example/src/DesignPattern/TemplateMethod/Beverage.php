<?php

namespace Adriatic\PHPAkademija\DesignPattern\TemplateMethod;

abstract class Beverage
{
    final public function prepare()
    {
        $this->boilWater();
        $this->brew();
        $this->pourInCup();
        $this->addCondiments();
    }

    abstract protected function brew();
    abstract protected function addCondiments();

    protected function pourInCup()
    {
        echo "Ulijevam u šalicu\n";
    }

    protected function boilWater()
    {
        echo "Prokuhavam vodu\n";
    }
}
