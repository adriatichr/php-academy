<?php

// http://phpacademy.example.{inicijali}/web/OOPExamples/LooseVsStrictComparison.php
require_once __DIR__.'/../../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\Car;

echo '<h4>Primjer sa objektima</h4>';

$carA = new Car('green');
$carB = new Car('green');

d($carA == $carB);
d($carA === $carB);

// I $carC i $carA pokazuju na isti objekt u memoriji
$carC = $carA;
d($carA === $carC);

echo '<h4>Primjer usporedbi osnovnih tipova</h4>';
d(0 == "");
d(0 === "");
d(false == "");
d(false === "");
d(0 == "0");
d(0 === "0");
d(false == "0");
d(5.0 == "5");
d(5.0 == "5.0");
d(5.0 == 5);
d(5.0 === 5);
