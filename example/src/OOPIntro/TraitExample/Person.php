<?php

namespace Adriatic\PHPAkademija\OOPIntro\TraitExample;

class Person
{
    private $name;
    private $surname;

    public function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }
}
