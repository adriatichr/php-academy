<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components;

class SedanBodyConfiguration implements BodyConfiguration
{
    public function name() : string
    {
        return 'Sedan';
    }
}
