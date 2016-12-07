<?php

namespace Adriatic\PHPAkademija\OOPIntro;

class Car
{
    const NUMBER_OF_WHEELS = 4;

    public static $carsCreated = 0;

    private $speed = 0;
    private $fuelPercentage = 0;
    private $color;

    public static function calculateFuelConsumption($mileage, $fuelConsumed)
    {
        return $fuelConsumed / ($mileage / 100);
    }

    /**
     * Boju moramo specificirati kod stvaranja svake instance auta. Kako klasa nema metode za promjene boje, ovo znači da
     * njen korisnik ne može mijenjati boju auta nakon što je stvoren.
     */
    public function __construct($color)
    {
        /**
         * Unutar metode klase se može pristupiti svim njenim metodama i svojstvima koristeći pseudo-varijablu $this.
         */
        $this->color = $color;
        self::$carsCreated++;
    }

    public function speedUp($increment)
    {
        $this->speed += $increment;
    }

    /**
     * Kako je ova metoda jedini način da se auto uspori, ovdje možemo dodati provjeru da se ne može više usporiti ako je
     * brzina već nula.
     */
    public function slowDown($decrement)
    {
        if($decrement > $this->speed)
            $this->speed = 0;
        else
            $this->speed -= $decrement;
    }

    public function turnLeft()
    {
        echo 'Skrećem lijevo';
    }

    public function turnRight()
    {
        echo 'Skrećem desno';
    }

    public function getCurrentSpeed()
    {
        return $this->speed;
    }

    public function getFuelPercentage()
    {
        return $this->fuelPercentage;
    }

    public function getColor()
    {
        return $this->color;
    }
}
