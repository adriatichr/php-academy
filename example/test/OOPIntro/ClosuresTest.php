<?php

use PHPUnit\Framework\TestCase;

class ClosuresTest extends TestCase
{
    /** @test */
    public function sumClosure()
    {
        $this->expectOutputString('9');
        require_once __DIR__ . '/../../src/OOPIntro/Closures.php';
    }
}
