<?php

require_once __DIR__ . '/../../../src/OOPIntro/StaticMethodsAndVariables/StaticVariables.php';

use PHPUnit\Framework\TestCase;

class StaticVariablesTest extends TestCase
{
    /** @test */
    public function fooCountsItsCalls()
    {
        $this->assertEquals('Funkcija pozvana 1 puta.', selfCallCounting());
        $this->assertEquals('Funkcija pozvana 2 puta.', selfCallCounting());
        $this->assertEquals('Funkcija pozvana 3 puta.', selfCallCounting());
    }
}
