<?php

namespace Adriatic\PHPAkademija\OOPIntro\Inheritance;

class Employee extends Person
{
    private $salary;

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getReversedName()
    {
        return $this->surname . ', ' . $this->name;
    }
}
