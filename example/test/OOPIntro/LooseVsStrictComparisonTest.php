<?php

use Adriatic\PHPAkademija\OOPIntro\Car;
use PHPUnit\Framework\TestCase;

class LooseVsStrictComparisonTest extends TestCase
{
    /** @test */
    public function objectIdentityVersusObjectEquality()
    {
        $carA = new Car('green');
        $carB = new Car('green');

        $this->assertTrue($carA == $carB);
        $this->assertFalse($carA === $carB);

        // I $carC i $carA pokazuju na isti objekt u memoriji
        $carC = $carA;
        $this->assertTrue($carA === $carC);
    }

    /**
     * @test
     * @link http://php.net/manual/en/types.comparisons.php tablice PHP usporedbi
     */
    public function strictAndNonStrictComparison()
    {
        $this->assertTrue(0 == "");
        $this->assertFalse(0 === "");
        $this->assertTrue(false == "");
        $this->assertFalse(false === "");
        $this->assertTrue(0 == "0");
        $this->assertFalse(0 === "0");
        $this->assertTrue(false == "0");
        $this->assertTrue(5.0 == "5");
        $this->assertTrue(5.0 == "5.0");
        $this->assertTrue(5.0 == 5);
        $this->assertFalse(5.0 === 5);
    }
}
