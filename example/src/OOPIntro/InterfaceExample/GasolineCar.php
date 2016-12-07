<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

class GasolineCar implements Driveable
{
    public function steerLeft()
    {
        // Implementacija skretanja lijevo
    }

    public function steerRight()
    {
        // Implementacija skretanja desno
    }

    public function driveForward()
    {
        // Implementacija koja koristi benzinski motor za vožnju prema naprijed
    }

    public function driveReverse()
    {
        // Implementacija koja koristi benzinski motor za vožnju unazad
    }

    public function brake()
    {
        // Implementacija kočenja
    }
}
