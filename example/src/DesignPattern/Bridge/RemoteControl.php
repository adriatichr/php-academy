<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge;

abstract class RemoteControl
{
    private $tvImpl;

    public function __construct(Tv $tvImpl)
    {
        $this->tvImpl = $tvImpl;
    }

    public function on()
    {
        $this->tvImpl->on();
    }

    public function off()
    {
        $this->tvImpl->off();
    }

    public function setChannel(int $channel)
    {
        $this->tvImpl->tuneChannel($channel);
    }
}
