<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge\InitialSolution;

use Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations\SonyTv;

class SonyControl implements RemoteControl
{
    private $sonyTv;

    public function __construct(SonyTv $sonyTv)
    {
        $this->sonyTv = $sonyTv;
    }

    public function on()
    {
        $this->sonyTv->on();
    }

    public function off()
    {
        $this->sonyTv->off();
    }

    public function setChannel(int $channel)
    {
        $this->sonyTv->setChannel($channel);
    }
}
