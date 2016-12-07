<?php

namespace Adriatic\PHPAkademija\OOPIntro\TraitExample;

class Employee extends Person
{
    use PoliteTrait;
    use IntroductionTrait;

    private $salary;

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}
