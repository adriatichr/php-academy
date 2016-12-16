<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

class GasolineCar implements Driveable
{
    public function steerLeft() : string
    {
        // Implementacija skretanja lijevo
        return 'Benzinac skreće lijevo';
    }

    public function steerRight() : string
    {
        // Implementacija skretanja desno
        return 'Benzinac skreće desno';
    }

    public function driveForward() : string
    {
        // Implementacija koja koristi benzinski motor za vožnju prema naprijed
        return 'Benzinac vozi naprijed';
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
