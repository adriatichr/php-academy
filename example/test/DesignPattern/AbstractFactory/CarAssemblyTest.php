<?php

namespace Adriatic\PHPAkademija\DesignPattern\AbstractFactory;

use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\Car;
use Adriatic\PHPAkademija\DesignPattern\AbstractFactory\ElectricHatchbackComponentFactory;
use PHPUnit\Framework\TestCase;

class CarAssemblyTest extends TestCase
{
    /** @test */
    public function electricCarAssembly()
    {
        $car = new CarAssembly(new ElectricHatchbackComponentFactory());
        $this->assertEquals([
            'Sastavljam motor: Električni',
            'Sastavljam šasiju: Hatchback',
            'Sastavljam ovjes: Torzioni ovjes',
            'Sastavljam kotače sa gumama: Continental',
        ], $car->assemble());
    }

    /** @test */
    public function gasolineSedanCarAssembly()
    {
        $car = new CarAssembly(new GasolineSedanComponentFactory());
        $this->assertEquals([
            'Sastavljam motor: Benzinac',
            'Sastavljam šasiju: Sedan',
            'Sastavljam ovjes: Zračni ovjes',
            'Sastavljam kotače sa gumama: Michelin',
        ], $car->assemble());
    }
}
