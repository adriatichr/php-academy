<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Observer;

use Adriatic\PHPAkademija\DesignPattern\Observer\DepartmentEmployee;
use Adriatic\PHPAkademija\DesignPattern\Observer\DepartmentHead;
use PHPUnit\Framework\TestCase;

class ObserverTest extends TestCase
{
    /** @test */
    public function departmentStateChange()
    {
        $gs = new DepartmentHead();
        $department = $this->getDepartment();

        foreach ($department as $departmentEmployee) {
            $gs->add($departmentEmployee);
        }

        $employee = array_pop($department);
        $gs->setAtWork(true);
        $this->assertEquals('I am working', $employee->getState());
        $gs->setAtWork(false);
        $this->assertEquals('To the party room!', $employee->getState());
        $gs->remove($employee);
        $gs->setAtWork(true);
        $this->assertEquals('To the party room!', $employee->getState());
        foreach ($department as $departmentEmployee) {
            $this->assertEquals('I am working', $departmentEmployee->getState());
        }
    }

    private function getDepartment() : array
    {
        return [
            new DepartmentEmployee('bc'),
            new DepartmentEmployee('dl'),
            new DepartmentEmployee('ks'),
            new DepartmentEmployee('pa'),
            new DepartmentEmployee('tb'),
            new DepartmentEmployee('tt'),
            new DepartmentEmployee('vb'),
            new DepartmentEmployee('zb'),
            new DepartmentEmployee('zv'),
        ];
    }
}
