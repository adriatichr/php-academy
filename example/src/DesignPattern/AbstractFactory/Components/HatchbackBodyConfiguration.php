<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components;

class HatchbackBodyConfiguration implements BodyConfiguration
{
    public function name() : string
    {
        return 'Hatchback';
    }
}
