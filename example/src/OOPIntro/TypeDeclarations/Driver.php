<?php

namespace Adriatic\PHPAkademija\OOPIntro\TypeDeclarations;

use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\Driveable;

class Driver
{
    private $car;

    /**
     * U ovom slučaju type declaration je interface Driveable. Kôdiranje prema interfaceu nam omogućuje da variramo
     * implementaciju auta bez potrebe za mijenjanjem kôda u Driver klasi.
     */
    public function getInACar(Driveable $car)
    {
        $this->car = $car;
    }

    public function driveInCircles($numberOfCircles)
    {
        if(!$this->car)
            throw new \LogicException('Ali ja nemam auto!');

        $driveLog = [];

        for ($i = 0; $i < $numberOfCircles; $i++) {
            $driveLog[] = $this->car->driveForward();
            $driveLog[] = $this->car->steerLeft();
            $driveLog[] = $this->car->driveForward();
            $driveLog[] = $this->car->steerLeft();
            $driveLog[] = $this->car->driveForward();
            $driveLog[] = $this->car->steerLeft();
            $driveLog[] = $this->car->driveForward();
            $driveLog[] = $this->car->steerLeft();
        }

        return $driveLog;
    }
}
