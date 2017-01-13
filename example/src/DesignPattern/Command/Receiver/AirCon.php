<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command\Receiver;

class AirCon
{
    public function heatingOn(int $degreesCelsius)
    {
        echo sprintf("Uključeno grijanje na %sC\n", $degreesCelsius);
    }

    public function heatingOff()
    {
        echo "Isključeno grijanje\n";
    }

    public function coolingOn(int $degreesCelsius)
    {
        echo sprintf("Uključeno hlađenje na %sC\n", $degreesCelsius);
    }

    public function coolingOff()
    {
        echo "Isključeno hlađenje\n";
    }
}
