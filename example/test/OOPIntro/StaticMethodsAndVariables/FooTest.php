<?php

use Adriatic\PHPAkademija\OOPIntro\StaticMethodsAndVariables\Foo;
use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    /** @test */
    public function staticMethodCall()
    {
        $this->assertEquals('Hello world', Foo::bar());
    }
}
