<?php

// http://phpacademy.example.{inicijali}/OOPExamples/Inheritance.php
require_once __DIR__.'/../../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\Inheritance\Employee;
use Adriatic\PHPAkademija\OOPIntro\Inheritance\Manager;
use Adriatic\PHPAkademija\OOPIntro\Inheritance\Person;

$person = new Person('John', 'Smith');
$employee = new Employee('Mate', 'Matić');
$manager = new Manager('Ana', 'Anić', /* Salary is */2000, /* Bonus is */500);

echo 'Osoba: ' . $person->getFullName();
echo '<br />';
echo 'Zaposlenik: ' . $employee->getFullName();
echo '<br />';
echo 'Manager: ' . $manager->getFullName();
