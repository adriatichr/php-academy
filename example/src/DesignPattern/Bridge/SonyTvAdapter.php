<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge;

use Adriatic\PHPAkademija\DesignPattern\Bridge\TvImplementations\SonyTv;

class SonyTvAdapter implements Tv
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

    public function tuneChannel(int $channel)
    {
        $this->sonyTv->setChannel($channel);
    }
}
