<?php

// http://phpacademy.example.{inicijali}/OOPExamples/AbstractClass.php

require_once __DIR__ . '/../../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\AbstractClass\DieselCar;
use Adriatic\PHPAkademija\OOPIntro\AbstractClass\ElectricCar;

$electricCar = new ElectricCar();
$dieselCar = new DieselCar();
?>

<p>
    Klase ElectricCar i DieselCar obje <strong>nasljeđuju</strong> apstraktnu klasu
    <strong>\Adriatic\PHPAkademija\OOPIntro\AbstractClass\AbstractCar</strong> u kojoj je implementirana metoda
    <strong>steer($direction)</strong>. Kako ni <strong>ElectricCar</strong> ni <strong>DieselCar</strong> ne
    implementiraju svoju verziju ove metode, kod njenog poziva na njihovim instancama se uvijek poziva
    <strong>steer()</strong> metoda definirana u <strong>AbstractCar</strong> klasi.
    <br />
    <br />

    <?php
    echo 'Električni auto: ' . $electricCar->steer('left');
    echo '<br />';
    echo 'Dizelski auto: ' . $dieselCar->steer('left');
    echo '<br />';
    echo 'Električni auto: ' . $electricCar->steer('right');
    echo '<br />';
    echo 'Dizelski auto: ' . $dieselCar->steer('right');
    echo '<br />';
    ?>
</p>

<p>
    Abstraktna klasa <strong>\Adriatic\PHPAkademija\OOPIntro\AbstractClass\AbstractCar</strong> definira i tzv.
    abstraktnu metodu <strong>driveForward()</strong>. Abstraktne metode nemaju tijelo metode, nego su za njihovu
    implementaciju zadužene klase koje nasljeđuju abstraktnu klasu.
    <br />
    Ako podklasa ne implementira abstraktnu metodu php će nam javiti grešku i zaustaviti izvođenje programa. Podklasa se
    u tom slučaju mora ili proglasiti abstraktnom, ili implementirati abstraktnu metodu.
    <br />
    Abstraktne klase se ne mogu instancirati.
    <br />
    <br />

    <?php
    echo 'Električni auto: ' . $electricCar->driveForward();
    echo '<br />';
    echo 'Dizelski auto: ' . $dieselCar->driveForward();
    ?>
</p>

