<?php

namespace Adriatic\PHPAkademija\OOPIntro\Inheritance;

/**
 * Employee nasljeđuje metodu getFullName() od Person klase.
 */
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
