<?php

namespace Adriatic\PHPAkademija\DesignPattern\Strategy;

class Squeak implements QuackBehavior
{
    public function quack() : string
    {
        return 'Squeak';
    }
}
