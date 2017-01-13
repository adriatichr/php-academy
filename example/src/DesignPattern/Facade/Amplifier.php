<?php

namespace Adriatic\PHPAkademija\DesignPattern\Facade;

class Amplifier
{
    public function on()
    {
        echo 'Uključeno pojačalo<br />';
    }

    public function setVolumeLevel(int $volumeLevel)
    {
        echo sprintf('Glasnoća postavljena na razinu %s<br />', $volumeLevel);
    }

    public function off()
    {
        echo 'Isključeno pojačalo<br />';
    }
}
