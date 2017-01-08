<?php

namespace Adriatic\PHPAkademija\DesignPattern\State;

class Standing implements State
{
    private $character;

    public function __construct(GameCharacter $character)
    {
        $this->character = $character;
    }

    public function stop() : string
    {
        return 'Već sam stao';
    }

    public function walk() : string
    {
        $this->character->setState($this->character->getWalkingState());

        return 'Krećem u hod, hodam';
    }

    public function run() : string
    {
        $this->character->setState($this->character->getRunningState());

        return 'Krećem u trk, trčim';
    }

    public function jump() : string
    {
        $this->character->setState($this->character->getJumpingState());

        return 'Skačem na mjestu';
    }
}
