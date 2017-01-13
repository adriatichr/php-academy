<?php

namespace Adriatic\PHPAkademija\DesignPattern\Facade;

class Television
{
    public function on()
    {
        echo 'Uključen TV<br />';
    }

    public function setSource(string $source)
    {
        echo sprintf('Izvor postavljen na "%s"<br />', $source);
    }

    public function setBrightness(int $brightnessLevel)
    {
        echo sprintf('Svjetlina postavljena na razinu %s<br />', $brightnessLevel);
    }

    public function off()
    {
        echo 'Isključen TV<br />';
    }
}
