<?php

namespace Adriatic\PHPAkademija\AutomatedTesting;

use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private $calculator;

    public function setUp()
    {
        $this->calculator = new StringCalculator();
    }

    /** @test */
    public function shouldReturnZeroIfStringIsEmpty()
    {
        $this->assertSame(0, $this->calculator->add(''));
    }

    /** @test */
    public function shouldReturnNumberIfStringContainsSingleNumber()
    {
        $this->assertSame(1, $this->calculator->add('1'));
        $this->assertSame(42, $this->calculator->add('42'));
    }

    /** @test */
    public function givenStringWithTwoCommaSeparatedNumbersShouldReturnTheirSum()
    {
        $this->assertSame(3, $this->calculator->add('1,2'));
    }

    /** @test */
    public function shouldWorkForMultipleNumbers()
    {
        $this->assertSame(6, $this->calculator->add('1,2,3'));
        $this->assertSame(210, $this->calculator->add('50,60,100'));
    }

    /** @test */
    public function shouldAllowNewlineAsDelimiter()
    {
        $this->assertSame(3, $this->calculator->add("1\n2"));
        $this->assertSame(7, $this->calculator->add("1\n2\n4"));
    }

    /** @test */
    public function shouldAllowCombinationOfCommaAndNewlineDelimiter()
    {
        $this->assertSame(6, $this->calculator->add("1,2\n3"));
    }

    /** @test */
    public function shouldSupportDefiningOurOwnDelimiter()
    {
        $this->assertSame(6, $this->calculator->add("#;\n1;2;3"));
    }

    /** @test */
    public function shouldSupportAnyCombinationOfPossibleDelimiters()
    {
        $this->assertSame(10, $this->calculator->add("#;\n1;2\n3,4"));
    }
}
