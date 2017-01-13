<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components;

class AirSuspension implements Suspension
{
    public function type() : string
    {
        return 'Zračni ovjes';
    }
}
