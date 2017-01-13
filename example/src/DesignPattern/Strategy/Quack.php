<?php

namespace Adriatic\PHPAkademija\DesignPattern\Strategy;

class Quack implements QuackBehavior
{
    public function quack() : string
    {
        return 'Quack';
    }
}
