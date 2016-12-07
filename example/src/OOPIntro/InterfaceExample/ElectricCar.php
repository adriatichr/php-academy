<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

class ElectricCar implements Driveable
{
    public function steerLeft()
    {
        return 'Skrećem lijevo';
    }

    public function steerRight()
    {
        return 'Skrećem desno';
    }

    public function driveForward()
    {
        // Implementacija koja koristi baterije i elektromotor umjesto motora sa unutrašnjim izgaranjem
        // ...
        //
        return 'Vozim ravno';
    }

    public function driveReverse()
    {
        // Implementacija koja koristi baterije umjesto benzina
    }

    public function brake()
    {
        // Implementacija kočenja
    }
}
