<?php

namespace Adriatic\PHPAkademija\OOPIntro\TraitExample;

class Manager extends Employee
{
    use AngryTrait;

    private $salaryBonus;

    public function __construct($name, $surname)
    {
        parent::__construct($name, $surname);
        $this->salaryBonus = 500;
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
