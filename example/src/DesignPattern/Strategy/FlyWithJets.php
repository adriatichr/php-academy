<?php

namespace Adriatic\PHPAkademija\DesignPattern\Strategy;

class FlyWithJets implements FlyBehavior
{
    public function fly() : string
    {
        return 'Leti uz pomoć mlaznih motora';
    }
}
