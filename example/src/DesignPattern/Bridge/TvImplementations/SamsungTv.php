<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations;

class SamsungTv
{
    public function startUp()
    {
        echo "Uključujem Samsung Tv\n";
    }

    public function turnOff()
    {
        echo "Gasim Samsung Tv\n";
    }

    public function tuneChannel(int $channel)
    {
        echo sprintf("Postavljam Samsung kanal na %s\n", $channel);
    }
}
