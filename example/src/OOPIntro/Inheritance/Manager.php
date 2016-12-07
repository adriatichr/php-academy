<?php

namespace Adriatic\PHPAkademija\OOPIntro\Inheritance;

class Manager extends Employee
{
    private $salaryBonus;

    public function __construct($name, $surname, $salary, $salaryBonus)
    {
        parent::__construct($name, $surname);
        $this->salaryBonus = $salaryBonus;
        $this->setSalary($salary);
    }

    public function getSalary()
    {
        return parent::getSalary() + $this->salaryBonus;
    }

    public function getFullName()
    {
        return 'Direktor ' . parent::getFullName();
    }
}
