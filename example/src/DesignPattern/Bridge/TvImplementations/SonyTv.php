<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations;

class SonyTv
{
    public function on()
    {
        echo "Uključujem Sony Tv\n";
    }

    public function off()
    {
        echo "Gasim Sony Tv\n";
    }

    public function setChannel(int $channel)
    {
        echo sprintf("Postavljam Sony kanal na %s\n", $channel);
    }
}
