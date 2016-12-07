<?php

use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\DieselCar;
use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\Driveable;
use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\ElectricCar;
use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\GasolineCar;
use PHPUnit\Framework\TestCase;

class DriveableTest extends TestCase
{
    /** @test */
    public function gasolineCarImplementsDriveable()
    {
        $this->assertInstanceOf(Driveable::class, new GasolineCar());
    }

    /** @test */
    public function dieselCarImplementsDriveable()
    {
        $this->assertInstanceOf(Driveable::class, new DieselCar());
    }

    /** @test */
    public function electricCarImplementsDriveable()
    {
        $this->assertInstanceOf(Driveable::class, new ElectricCar());
    }
}
