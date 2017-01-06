<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge;

use Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations\SamsungTv;

class SamsungTvAdapter implements Tv
{
    private $samsungTv;

    public function __construct(SamsungTv $samsungTv)
    {
        $this->samsungTv = $samsungTv;
    }

    public function on()
    {
        $this->samsungTv->startUp();
    }

    public function off()
    {
        $this->samsungTv->turnOff();
    }

    public function tuneChannel(int $channel)
    {
        $this->samsungTv->tuneChannel($channel);
    }
}
