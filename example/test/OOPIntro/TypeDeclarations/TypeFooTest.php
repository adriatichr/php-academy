<?php

declare(strict_types=0);

use Adriatic\PHPAkademija\OOPIntro\TypeDeclarations\TypeFoo;
use PHPUnit\Framework\TestCase;

class TypeFooTest extends TestCase
{
    public function setUp()
    {
        $this->foo = new TypeFoo();
    }

    /** @test */
    public function strictAndNonStrictImplicitConversion()
    {
        $this->assertEquals(12, $this->foo->sum('5', 7));
        $this->assertEquals(12, $this->foo->sum('5a', 7));
        $this->assertEquals(12, $this->foo->sumStrict('5', 7));
        $this->expectException(PHPUnit_Framework_Error::class);
        $this->foo->sumStrict('5a', 7);
    }

    /** @test */
    public function implicitConversionOfTypesUsingTypeDeclarations()
    {
        $this->assertSame(5, $this->foo->implicitIntegerConversion('5'));
        $this->assertSame(5, $this->foo->implicitIntegerConversion(5.0));
        $this->assertSame(1, $this->foo->implicitIntegerConversion(true));
        $this->assertSame(0, $this->foo->implicitIntegerConversion(false));

        $this->assertSame('5', $this->foo->implicitStringConversion(5));
        $this->assertSame('5', $this->foo->implicitStringConversion(5.0));
        $this->assertSame('1', $this->foo->implicitStringConversion(true));
        $this->assertSame('', $this->foo->implicitStringConversion(false));

        $this->assertSame(5.0, $this->foo->implicitFloatConversion(5));
        $this->assertSame(5.0, $this->foo->implicitFloatConversion('5'));
        $this->assertSame(1.0, $this->foo->implicitFloatConversion(true));
        $this->assertSame(0.0, $this->foo->implicitFloatConversion(false));

        $this->assertSame(true, $this->foo->implicitBoolConversion(5));
        $this->assertSame(false, $this->foo->implicitBoolConversion(0));
        $this->assertSame(true, $this->foo->implicitBoolConversion('true'));
        $this->assertSame(true, $this->foo->implicitBoolConversion('false'));
        $this->assertSame(false, $this->foo->implicitBoolConversion(''));
        $this->assertSame(false, $this->foo->implicitBoolConversion(0.0));
        $this->assertSame(true, $this->foo->implicitBoolConversion(5.0));
    }
}
