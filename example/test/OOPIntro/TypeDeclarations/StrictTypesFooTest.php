<?php

declare(strict_types=1);

use Adriatic\PHPAkademija\OOPIntro\TypeDeclarations\TypeFoo;
use PHPUnit\Framework\TestCase;

class StrictTypesFooTest extends TestCase
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
        $this->expectException(TypeError::class);
        $this->foo->sumStrict('5', 7);
    }

    /** @test */
    public function stringWithNumericAndNonNumericCharacters()
    {
        $this->expectException(TypeError::class);
        $this->foo->sumStrict('5a', 7);
    }

    /**
     * @testWith ["5"]
     *           [5.0]
     *           [true]
     *           [false]
     */
    public function noImplicitConversionForIntegerTypesUsingTypeDeclarations($inputParameter)
    {
        $this->expectException(TypeError::class);
        $this->foo->implicitIntegerConversion($inputParameter);
    }

    /**
     * @testWith [5]
     *           [5.0]
     *           [true]
     *           [false]
     */
    public function noImplicitConversionForStringTypesUsingTypeDeclarations($inputParameter)
    {
        $this->expectException(TypeError::class);
        $this->foo->implicitStringConversion($inputParameter);
    }

    /** @test */
    public function implicitFloatConversionWhenParameterIsInteger()
    {
        $this->assertSame(5.0, $this->foo->implicitFloatConversion(5));
    }

    /**
     * @testWith ["5"]
     *           [true]
     *           [false]
     */
    public function noImplicitConversionForFloatTypesUsingTypeDeclarations($inputParameter)
    {
        $this->expectException(TypeError::class);
        $this->foo->implicitFloatConversion($inputParameter);
    }

    /**
     * @testWith [5]
     *           [0]
     *           ["true"]
     *           ["false"]
     *           [""]
     *           [0.0]
     *           [5.0]
     */
    public function noImplicitConversionForBoolTypesUsingTypeDeclarations($inputParameter)
    {
        $this->expectException(TypeError::class);
        $this->foo->implicitBoolConversion($inputParameter);
    }
}
