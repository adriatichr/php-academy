<?php

namespace Adriatic\PHPAkademija\DesignPattern\TemplateMethod;

class Coffee extends Beverage
{
    protected function brew()
    {
        echo "Stavljam kavu u vodu\n";
    }

    protected function addCondiments()
    {
        echo "Dodajem šećera i mlijeka\n";
    }
}
