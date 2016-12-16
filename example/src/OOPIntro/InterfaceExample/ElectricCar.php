<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

class ElectricCar implements Driveable
{
    public function steerLeft() : string
    {
        return 'Skrećem lijevo';
    }

    public function steerRight() : string
    {
        return 'Skrećem desno';
    }

    public function driveForward() : string
    {
        // Implementacija koja koristi baterije i elektromotor umjesto motora sa unutrašnjim izgaranjem
        return 'Vozim ravno';
    }

    public function driveReverse()
    {
        // Implementacija koja koristi baterije umjesto motora sa unutrašnjim izgaranjem
    }

    public function brake()
    {
        // Implementacija kočenja
    }
}
