<?php

namespace Adriatic\PHPAkademija\DesignPattern\TemplateMethod;

class Tea extends Beverage
{
    protected function brew()
    {
        echo "Stavljam čaj u vodu\n";
    }

    protected function addCondiments()
    {
        echo "Dodajem limuna\n";
    }
}
