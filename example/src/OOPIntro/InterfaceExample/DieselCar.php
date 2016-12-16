<?php

namespace Adriatic\PHPAkademija\OOPIntro\InterfaceExample;

class DieselCar implements Driveable
{
    public function steerLeft() : string
    {
        // Implementacija skretanja lijevo
        return 'Dizelaš skreće lijevo';
    }

    public function steerRight() : string
    {
        // Implementacija skretanja desno
        return 'Dizelaš skreće desno';
    }

    public function driveForward() : string
    {
        // Implementacija koja troši manje goriva od benzinskog auta
        return 'Dizelaš vozi naprijed';
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
