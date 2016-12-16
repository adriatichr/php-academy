<?php

// http://phpacademy.example.{inicijali}/web/OOPExamples/Exceptions.php
require_once __DIR__.'/../../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\Exceptions\Employee;

$employee = new Employee();

try {
    $employee->setSalary(4999);
} catch (LogicException $e) {
    // Pokušavamo se oporaviti od greške tako da zaposleniku damo bolju ponudu
    $employee->setSalary(8500);
}

echo '<h3>Primjer hvatanja LogicException iznimke</h3>';
echo 'Plaća zaposlenika je sada '.$employee->getSalary().'.';
echo '<br />';

try {
    $employee->setSalary(-500);
// Kako smo u catch blok stavili type hint na LogicException, to znači da će ovaj catch blok uhvatiti samo iznimke klase
// LogicException ili njene podklase
} catch (LogicException $e) {
    $employee->setSalary(8500);
} catch (InvalidArgumentException $e) {
    $employee->setSalary(7501);
// Kôd u finally bloku se uvijek izvršava, bez obzira je li iznimka bačena ili ne
} finally {
    $employee->setSalary($employee->getSalary() + 1234);
}

echo '<h3>Primjer InvalidArgumentException iznimke</h3>';
echo 'Plaća zaposlenika je sada '.$employee->getSalary().'.';
echo '<br />';

try {
    $employee->setSalary(10000);
// Kôd u finally bloku se uvijek izvršava, bez obzira je li iznimka bačena ili ne
} finally {
    $employee->setSalary(8000);
}

echo '<h3>Primjer finally bloka kada kôd nije bacio iznimku</h3>';
echo 'Plaća zaposlenika je sada '.$employee->getSalary().'.';
echo '<br />';

// Ako u catch bloku ne uhvatimo odgovarajuću iznimku, php će zaustaviti izvršavanje programa
try {
    $employee->setSalary(-500);
} catch (RuntimeException $e) {
    $employee->setSalary(8500);
}

echo 'Ovaj tekst se neće ispisati na ekran zbog neuhvaćene iznimke.';
