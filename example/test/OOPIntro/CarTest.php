<?php

use PHPUnit\Framework\TestCase;
use Adriatic\PHPAkademija\OOPIntro\Car;

class CarTest extends TestCase
{
    private $car;

    public function setUp()
    {
        $this->car = new Car('white');
    }

    /** @test */
    public function carsCreatedStaticProperty()
    {
        $this->assertEquals(1, Car::$carsCreated);
        new Car('green');
        $this->assertEquals(2, Car::$carsCreated);
        new Car('red');
        new Car('blue');
        $this->assertEquals(4, Car::$carsCreated);
    }

    /** @test */
    public function carSpeedShouldBeZeroWhenFirstCreated()
    {
        $this->assertSame(0, $this->car->getCurrentSpeed());
    }

    /** @test */
    public function carFuelTankShouldBeEmptyWhenFirstCreated()
    {
        $this->assertSame(0, $this->car->getFuelPercentage());
    }

    /** @test */
    public function speedUpShouldIncreasSpeedByGivenIncrement()
    {
        $this->car->speedUp(10);
        $this->assertSame(10, $this->car->getCurrentSpeed());
    }

    /** @test */
    public function slowDownShouldSlowCarDownByGivenDecrement()
    {
        $this->car->speedUp(20);
        $this->car->slowDown(10);
        $this->assertSame(10, $this->car->getCurrentSpeed());
    }

    /** @test */
    public function shouldNotSlowDownBelowZeroSpeed()
    {
        // Ovo je jedna od prednosti enkapsulacije: kako je smanjenje brzine jedino moguće preko slowDown() metode, ona
        // vrši provjeru kako brzina ne bi išla ispod 0. Drugim riječima, Car klasa sada kontrolira način na koji se
        // usporava.
        $this->car->slowDown(10);
        $this->assertSame(0, $this->car->getCurrentSpeed());
    }

    /** @test */
    public function getCarColor()
    {
        $this->assertEquals('white', $this->car->getColor());
    }

    /** @test */
    public function carClassConstant()
    {
        $this->assertSame(4, Car::NUMBER_OF_WHEELS);
    }

    /** @test */
    public function staticMethodForCalculatingFuelConsumption()
    {
        $this->assertEquals(10, Car::calculateFuelConsumption(100, 10), null, 0.01);
        $this->assertEquals(10, Car::calculateFuelConsumption(200, 20), null, 0.01);
        $this->assertEquals(6.67, Car::calculateFuelConsumption(300, 20), null, 0.01);
    }
}
