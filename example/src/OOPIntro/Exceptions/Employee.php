<?php

namespace Adriatic\PHPAkademija\OOPIntro\Exceptions;

class Employee
{
    private $salary;

    public function setSalary(int $salary)
    {
        if ($salary < 0) {
            throw new \InvalidArgumentException('Are you insane?');
        }

        /**
         * Iznimke (eng. Exception) označavaju neki iznimni događaj koji prekida normalno izvođenje programa.
         * Kada metoda ili funkcija baci (eng. throw) iznimku, istu može uhvatiti (eng. catch) kôd koji je pozvao metodu
         * i izvršiti neki dodatni zadatak.
         */
        if ($salary < 5000) {
            throw new \LogicException('No way!');
        }

        // Ova linija kôda se neće izvršiti ako je prije nje bačena iznimka.
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }
}
