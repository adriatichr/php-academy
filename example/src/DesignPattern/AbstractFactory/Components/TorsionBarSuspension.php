<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components;

class TorsionBarSuspension implements Suspension
{
    public function type() : string
    {
        return 'Torzioni ovjes';
    }
}
