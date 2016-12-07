<?php

namespace Adriatic\PHPAkademija\OOPIntro\Exceptions;

class Employee
{
    private $salary;

    public function setSalary($salary)
    {
        if ($salary < 5000) {
            throw new \LogicException('No way!');
        }

        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}
