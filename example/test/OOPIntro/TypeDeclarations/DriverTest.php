<?php

use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\ElectricCar;
use Adriatic\PHPAkademija\OOPIntro\TypeDeclarations\Driver;
use PHPUnit\Framework\TestCase;

class DriverTest extends TestCase
{
    private $driver;

    public function setUp()
    {
        $this->driver = new Driver();
    }

    /** @test */
    public function newTest()
    {
        $this->driver->getInACar(new ElectricCar());
        $this->assertSame([
            'Vozim ravno',
            'Skrećem lijevo',
            'Vozim ravno',
            'Skrećem lijevo',
            'Vozim ravno',
            'Skrećem lijevo',
            'Vozim ravno',
            'Skrećem lijevo',
        ], $this->driver->driveInCircles(1));
    }

    /** @test */
    public function driverHasNoCar()
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Ali ja nemam auto!');
        $this->driver->driveInCircles(1);
    }

}
