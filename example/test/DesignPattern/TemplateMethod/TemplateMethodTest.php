<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\TemplateMethod;

use Adriatic\PHPAkademija\DesignPattern\TemplateMethod\Coffee;
use Adriatic\PHPAkademija\DesignPattern\TemplateMethod\Tea;
use PHPUnit\Framework\TestCase;

class TemplateMethodTest extends TestCase
{
    /** @test */
    public function prepareTea()
    {
        $beverage = new Tea();
        $this->expectOutputString("Prokuhavam vodu\nStavljam čaj u vodu\nUlijevam u šalicu\nDodajem limuna\n");
        $beverage->prepare();
    }

    /** @test */
    public function prepareCoffee()
    {
        $beverage = new Coffee();
        $this->expectOutputString("Prokuhavam vodu\nStavljam kavu u vodu\nUlijevam u šalicu\nDodajem šećera i mlijeka\n");
        $beverage->prepare();
    }
}
