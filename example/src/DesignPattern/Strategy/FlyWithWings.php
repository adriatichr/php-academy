<?php

namespace Adriatic\PHPAkademija\DesignPattern\Strategy;

class FlyWithWings implements FlyBehavior
{
    public function fly() : string
    {
        return 'Leti uz pomoć krila';
    }
}
