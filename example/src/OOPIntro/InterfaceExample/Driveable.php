<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

/**
 * Interface je ugovor koji implementirajuća klasa ima sa vanjskim svijetom.
 *
 * Implementirajuća klasa se obavezuje da će implementirati sve metode u ovom interface-u, sa istim tipom ulaznih
 * parametara i istim tipom povratnih vrijednosti kao što su definirane u interface-u.
 */
interface Driveable
{
    /**
     * Vrstu povratne vrijednosti možemo eksplicitno navesti u definiciji metode, odvojenu sa ":". U ovom slučaju
     * povratna vrijednost je string, što znači da ako ova metoda vrati neki drugi tip podatka, PHP će ga implicitno
     * pretvoriti u string.
     */
    public function steerLeft() : string;

    public function steerRight() : string;

    public function driveForward() : string;

    public function driveReverse();

    public function brake();
}
