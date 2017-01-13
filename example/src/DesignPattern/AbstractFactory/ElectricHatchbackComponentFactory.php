<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory;

use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\BodyConfiguration;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Engine;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\ElectricEngine;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\HatchbackBodyConfiguration;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Suspension;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\TorsionBarSuspension;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Wheels;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\FifteenInchWheels;

class ElectricHatchbackComponentFactory implements ComponentFactory
{
    public function createEngine() : Engine
    {
        return new ElectricEngine();
    }

    public function createSuspension() : Suspension
    {
        return new TorsionBarSuspension();
    }

    public function createBodyConfiguration() : BodyConfiguration
    {
        return new HatchbackBodyConfiguration();
    }

    public function createWheels() : Wheels
    {
        return new FifteenInchWheels('Continental');
    }
}
