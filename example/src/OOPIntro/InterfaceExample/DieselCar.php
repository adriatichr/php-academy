<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

class DieselCar implements Driveable
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
        // Implementacija koja troši manje goriva od benzinskog auta
    }

    public function driveReverse()
    {
        // Implementacija koja troši manje goriva od benzinskog auta
    }

    public function brake()
    {
        // Implementacija kočenja
    }
}
