<?php

namespace Adriatic\PHPAkademija\OOPIntro\Inheritance;

class Manager extends Employee
{
    private $salaryBonus;

    /**
     * Manager klasa override-a konstruktor Employee klase sa svojim konstruktorom koji prima dodatne parametre.
     */
    public function __construct($name, $surname, $salary, $salaryBonus)
    {
        // Override-anu metodu možemo pozvati u child klasi preko ključne riječi parent.
        parent::__construct($name, $surname);
        $this->salaryBonus = $salaryBonus;
        $this->setSalary($salary);
    }

    public function getSalary()
    {
        return parent::getSalary() + $this->salaryBonus;
    }

    /**
     * Override-a metodu getFullName() u Person klasi.
     */
    public function getFullName()
    {
        return 'Direktor ' . parent::getFullName();
    }
}
