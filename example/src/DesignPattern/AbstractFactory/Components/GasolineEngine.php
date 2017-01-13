<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components;

class GasolineEngine implements Engine
{
    public function type() : string
    {
        return 'Benzinac';
    }
}
