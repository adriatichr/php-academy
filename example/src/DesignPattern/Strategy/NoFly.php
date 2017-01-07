<?php

namespace Adriatic\PHPAkademija\DesignPattern\Strategy;

class NoFly implements FlyBehavior
{
    public function fly() : string
    {
        return 'Ne leti';
    }
}
