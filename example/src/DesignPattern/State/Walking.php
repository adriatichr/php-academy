<?php

namespace Adriatic\PHPAkademija\DesignPattern\State;

class Walking implements State
{
    private $character;

    public function __construct(GameCharacter $character)
    {
        $this->character = $character;
    }

    public function stop() : string
    {
        $this->character->setState($this->character->getStandingState());

        return 'Stajem';
    }

    public function walk() : string
    {
        return 'Već hodam';
    }

    public function run() : string
    {
        $this->character->setState($this->character->getRunningState());

        return 'Ubrzavam iz hoda u trk, trčim';
    }

    public function jump() : string
    {
        $this->character->setState($this->character->getJumpingState());

        return 'Skačem prema naprijed';
    }
}
