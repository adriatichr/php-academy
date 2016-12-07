<?php

use Adriatic\PHPAkademija\OOPIntro\Inheritance\Employee;
use Adriatic\PHPAkademija\OOPIntro\Inheritance\Manager;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    private $employee;

    public function setUp()
    {
        $this->employee = new Employee('Mate', 'Matić');
    }

    /** @test */
    public function getFullName()
    {
        $this->assertEquals('Mate Matić', $this->employee->getFullName());
    }

    /** @test */
    public function canSetAndGetSalary()
    {
        $this->employee->setSalary(1500);
        $this->assertSame(1500, $this->employee->getSalary());
    }

    /** @test */
    public function employeeCanGetReverseName()
    {
        $this->assertEquals('Matić, Mate', $this->employee->getReversedName());
    }

    /** @test */
    public function managerHasSpecialFullName()
    {
        $manager = new Manager('Mate', 'Matić', 2000, 500);
        $this->assertEquals('Direktor Mate Matić', $manager->getFullName());
    }

    /** @test */
    public function managerHasABonusToSalary()
    {
        $manager = new Manager('Mate', 'Matić', /* Salary is */2000, /* Salary bonus is */500);
        $this->assertSame(2500, $manager->getSalary());
    }
}
