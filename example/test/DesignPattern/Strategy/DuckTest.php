<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Strategy;

use Adriatic\PHPAkademija\DesignPattern\Strategy\Duck;
use Adriatic\PHPAkademija\DesignPattern\Strategy\FlyWithJets;
use Adriatic\PHPAkademija\DesignPattern\Strategy\FlyWithWings;
use Adriatic\PHPAkademija\DesignPattern\Strategy\NoFly;
use Adriatic\PHPAkademija\DesignPattern\Strategy\Quack;
use Adriatic\PHPAkademija\DesignPattern\Strategy\Squeak;
use PHPUnit\Framework\TestCase;

class DuckTest extends TestCase
{
    /** @test */
    public function createARealDuck()
    {
        $duck = new Duck(new FlyWithWings(), new Quack());
        $this->assertEquals('Leti uz pomoć krila', $duck->fly());
        $this->assertEquals('Quack', $duck->quack());
    }

    /** @test */
    public function createARobotDuck()
    {
        $duck = new Duck(new FlyWithJets(), new Quack());
        $this->assertEquals('Leti uz pomoć mlaznih motora', $duck->fly());
        $this->assertEquals('Quack', $duck->quack());
    }

    /** @test */
    public function createARubberDuck()
    {
        $duck = new Duck(new NoFly(), new Squeak());
        $this->assertEquals('Ne leti', $duck->fly());
        $this->assertEquals('Squeak', $duck->quack());
    }
}
