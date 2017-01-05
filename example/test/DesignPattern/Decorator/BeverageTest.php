<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Decorator;

use Adriatic\PHPAkademija\DesignPattern\Decorator\Decaf;
use Adriatic\PHPAkademija\DesignPattern\Decorator\Espresso;
use Adriatic\PHPAkademija\DesignPattern\Decorator\Milk;
use Adriatic\PHPAkademija\DesignPattern\Decorator\WhippedCream;
use PHPUnit\Framework\TestCase;

class BeverageTest extends TestCase
{
    /** @test */
    public function justEspresso()
    {
        $beverage = new Espresso();
        $this->assertEquals('Espresso', $beverage->getDescription());
        $this->assertEquals(6.49, $beverage->getCost(), null, 0.001);
    }

    /** @test */
    public function justDecaf()
    {
        $beverage = new Decaf();
        $this->assertEquals('Kava bez kofeina', $beverage->getDescription());
        $this->assertEquals(6.99, $beverage->getCost(), null, 0.001);
    }

    /** @test */
    public function espressoWithMilkAndWhippedCream()
    {
        $beverage = new Milk(new WhippedCream(new Espresso()));

        $this->assertEquals('Espresso sa šlagom sa mlijekom', $beverage->getDescription());
        $this->assertEquals(7.27, $beverage->getCost(), null, 0.001);
    }
}
