<?php

// http://phpacademy.example.{inicijali}/web/OOPExamples/Interface.php
require_once __DIR__.'/../../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\DieselCar;
use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\ElectricCar;
use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\GasolineCar;
use Adriatic\PHPAkademija\OOPIntro\TypeDeclarations\Driver;

/**
 * Razlike između interface-a i abstraktne klase:
 * * klasa može implementirati više interface-a, ali može naslijediti samo jednu abstraktnu klasu (PHP ne podržava
 *   višestruko nasljeđivanje)
 * * abstraktna klasa može definirati zadanu implementaciju za neke svoje metode, dok interface dopušta samo definiciju
 *   metoda bez implementacije (tj. bez tijela metode)
 */

$gasolineCar = new GasolineCar();
$dieselCar = new DieselCar();
$electricCar = new ElectricCar();

$driver = new Driver();

/**
 * Kako getInACar() metoda očekuje interface Driveable, to nam omogućuje da variramo implementaciju auta bez potrebe za
 * mijenjanjem kôda u Driver klasi. Dok god auto implementira Driveable interface, Driver klasa će ga znati koristiti.
 * Ovo nam omogućuje da mijenjamo implementaciju u hodu.
 */
$driver->getInACar($gasolineCar);
$gasolineCarDrivingLog = $driver->driveInCircles(1);
printDrivingLog($gasolineCarDrivingLog, 'Vozač vozi benzinski auto');

$driver->getInACar($dieselCar);
$dieselCarDrivingLog = $driver->driveInCircles(1);
printDrivingLog($dieselCarDrivingLog, 'Vozač vozi dizelski auto');

$driver->getInACar($electricCar);
$electricCarDrivingLog = $driver->driveInCircles(1);
printDrivingLog($electricCarDrivingLog, 'Vozač vozi električni auto');

function printDrivingLog(array $log, string $title)
{
    echo sprintf('<h3>%s</h3>', $title);
    echo '<p>';
    echo implode('<br />', $log);
    echo '</p>';
}