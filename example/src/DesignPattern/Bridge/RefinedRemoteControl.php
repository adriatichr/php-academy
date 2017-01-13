<?php

namespace Adriatic\PHPAkademija\DesignPattern\Bridge;

class RefinedRemoteControl extends RemoteControl
{
    private $channel;

    public function setChannel(int $channel)
    {
        $this->channel = $channel;
        parent::setChannel($channel);
    }

    public function nextChannel()
    {
        $this->setChannel($this->channel + 1);
    }

    public function previousChannel()
    {
        $this->setChannel($this->channel - 1);
    }
}
