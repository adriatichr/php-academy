<?php

use Adriatic\PHPAkademija\OOPIntro\AbstractClass\DieselCar;
use Adriatic\PHPAkademija\OOPIntro\AbstractClass\ElectricCar;
use PHPUnit\Framework\TestCase;

# Počinjemo sa dvije klase: ElectricCar i DieselCar
# U svakoj napravimo implementactiju skretanja u nekom smjeru
# Kako su obje implementacije iste, prebacujemo ih u apstraktnu klasu (eliminiramo duplikaciju)
#
# Zatim nam treba metoda za vožnju unaprijed: kako se ove implementacije razlikuju, u apstraktnoj klasi definiramo samo
# izgled metode i označavamo je kao apstraktnu. Na ovaj način prisiljavamo svaku klasu koja nasljeđuje AbstractCar da
# implementira metodu za vožnju unaprijed.
class AbstractClassTest extends TestCase
{
    /** @test */
    public function electricCarAndDieselCarSteerTheSameWay()
    {
        $electricCar = new ElectricCar();
        $dieselCar = new DieselCar();

        $this->assertEquals('Skrećem lijevo', $electricCar->steer('left'));
        $this->assertEquals('Skrećem lijevo', $dieselCar->steer('left'));
        $this->assertEquals('Skrećem desno', $electricCar->steer('right'));
        $this->assertEquals('Skrećem desno', $dieselCar->steer('right'));
    }

    /** @test */
    public function electricCarUsesElectromotorToDriveForward()
    {
        $electricCar = new ElectricCar();
        $this->assertEquals('Vozim naprijed koristeći električni motor.', $electricCar->driveForward());
    }

    /** @test */
    public function dieselCarUsesDieselEngineToDriveForward()
    {
        $electricCar = new DieselCar();
        $this->assertEquals('Vozim naprijed koristeći dizelski motor.', $electricCar->driveForward());
    }
}
