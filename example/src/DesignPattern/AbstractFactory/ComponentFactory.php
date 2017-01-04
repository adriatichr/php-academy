<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory;

use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Engine;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Suspension;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\BodyConfiguration;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Components\Wheels;

interface ComponentFactory
{
    public function createEngine() : Engine;
    public function createSuspension() : Suspension;
    public function createBodyConfiguration() : BodyConfiguration;
    public function createWheels() : Wheels;
}
