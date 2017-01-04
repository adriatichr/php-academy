<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components;

class ElectricEngine implements Engine
{
    public function type() : string
    {
        return 'Električni';
    }
}
