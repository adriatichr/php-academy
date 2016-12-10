<?php

use PHPUnit\Framework\TestCase;

class ClosuresTest extends TestCase
{
    private $foo = 'bar';

    /** @test */
    public function sumClosure()
    {
        $this->expectOutputString('9');
        require_once __DIR__ . '/../../src/OOPIntro/Closures.php';
    }

    /** @test */
    public function closureScope()
    {
        $closure = $this->getClosure();
        $this->assertEquals('bar', ($closure)());
    }

    /** @test */
    public function closureAutomaticallyBindsThisPseudoVariableWhenCreatedInObjectContext()
    {
        $closure = $this->getClosureWithThis();
        $this->assertEquals('bar', ($closure)());
    }

    private function getClosure()
    {
        $foo = 'bar';
        return function() use ($foo) {
            return $foo;
        };
    }

    private function getClosureWithThis()
    {
        return function() {
            return $this->foo;
        };
    }
}
