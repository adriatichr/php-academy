<?php

namespace Adriatic\PHPAkademija\OOPIntro\Exceptions;

use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    private $employee;

    public function setUp()
    {
        $this->employee = new Employee();
    }

    /** @test */
    public function employeeSetSalary()
    {
        $this->employee->setSalary(5000);
        $this->assertEquals(5000, $this->employee->getSalary());
    }

    /** @test */
    public function employeeThrowsExceptionIfGivenSalaryLessThan5000()
    {
        $this->expectException(\LogicException::class);
        $this->employee->setSalary(4999);
    }

    /** @test */
    public function unhandledException()
    {
        $this->markTestSkipped('Zakomentirati ovu liniju koda kako bi vidjeli iznimku na djelu');
        $this->employee->setSalary(4999);
    }

    /** @test */
    public function catchingExceptions()
    {
        try {
            $this->employee->setSalary(4999);
        } catch (\LogicException $e) {
            if ($e->getMessage() === 'No way!') {
                $this->perhapsWeCanNegotiate(5500);
            }
        }

        $this->assertEquals(5500, $this->employee->getSalary());
    }

    # Try blok može imati više catch blokova, svaki catch blok handle-a svoju specifičnu iznimku
    /** @test */
    public function ifCatchIsLookingForRuntimeExceptionItWontCatchLogicException()
    {
        try {
            $this->employee->setSalary(4999);
        } catch (\RuntimeException $e) {
            $this->fail('Do ove linije se neće doći jer Employee baca \LogicException kada pokušamo postaviti nisku plaću');
        } catch (\LogicException $e) {
            $this->perhapsWeCanNegotiate(6000);
        }

        $this->assertEquals(6000, $this->employee->getSalary());
    }

    /** @test */
    public function finallyBlockGetsExecutedEvenIfNoExceptionWasThrown()
    {
        try {
            $this->employee->setSalary(7500);
        } catch (\Exception $e) {
            $this->fail('Ovo se neće nikad izvršiti jer kod u try bloku ne baca iznimku.');
        } finally {
            $this->howAboutARaise(500);
        }
        $this->assertEquals(8000, $this->employee->getSalary());
    }

    /** @test */
    public function finallyBlockGetsExecutedEvenIfExceptionWasCaught()
    {
        try {
            $this->employee->setSalary(4000);
        # Catch blok je primjer polimorfizma jer handle-a više oblika exceptiona (LogicException, RuntimeException ...)
        } catch (\Exception $e) {
            $this->perhapsWeCanNegotiate(5000);
        } finally {
            $this->howAboutARaise(500);
        }
        $this->assertEquals(5500, $this->employee->getSalary());
    }

    private function perhapsWeCanNegotiate($newSalary)
    {
        $this->employee->setSalary($newSalary);
    }

    private function howAboutARaise($raise)
    {
        $this->employee->setSalary($this->employee->getSalary() + $raise);
    }
}
