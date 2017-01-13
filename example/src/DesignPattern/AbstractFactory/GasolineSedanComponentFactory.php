<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory;

use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\AirSuspension;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\BodyConfiguration;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Engine;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\GasolineEngine;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\SedanBodyConfiguration;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\SeventeenInchWheels;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Suspension;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Wheels;

class GasolineSedanComponentFactory implements ComponentFactory
{
    public function createEngine() : Engine
    {
        return new GasolineEngine();
    }

    public function createSuspension() : Suspension
    {
        return new AirSuspension();
    }

    public function createBodyConfiguration() : BodyConfiguration
    {
        return new SedanBodyConfiguration();
    }

    public function createWheels() : Wheels
    {
        return new SeventeenInchWheels('Michelin');
    }
}
