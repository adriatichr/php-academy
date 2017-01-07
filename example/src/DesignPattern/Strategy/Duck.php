<?php

namespace Adriatic\PHPAkademija\DesignPattern\Strategy;

class Duck
{
    private $flyBehavior;

    private $quackBehavior;

    public function __construct(FlyBehavior $flyBehavior, QuackBehavior $quackBehavior)
    {
        $this->flyBehavior = $flyBehavior;
        $this->quackBehavior = $quackBehavior;
    }

    public function swim() : string
    {
        return 'Plivam';
    }

    public function fly() : string
    {
        return $this->flyBehavior->fly();
    }

    public function quack() : string
    {
        return $this->quackBehavior->quack();
    }
}
