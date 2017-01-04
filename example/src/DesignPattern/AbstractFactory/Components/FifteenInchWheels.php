<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components;

class FifteenInchWheels implements Wheels
{
    private $tiresBrand;

    public function __construct($tiresBrand)
    {
        $this->tiresBrand = $tiresBrand;
    }

    public function tiresBrand() : string
    {
        return $this->tiresBrand;
    }
}
