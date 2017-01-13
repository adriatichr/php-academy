<?php

namespace Adriatic\PHPAkademija\DesignPattern\State;

class Running implements State
{
    private $character;

    public function __construct(GameCharacter $character)
    {
        $this->character = $character;
    }

    public function stop() : string
    {
        $this->character->setState($this->character->getStandingState());

        return 'Usporavam u hod, stojim';
    }

    public function walk() : string
    {
        $this->character->setState($this->character->getWalkingState());

        return 'Usporavam u hod, hodam';
    }

    public function run() : string
    {
        return 'Već trčim';
    }

    public function jump() : string
    {
        $this->character->setState($this->character->getJumpingState());

        return 'Skačem daleko prema naprijed';
    }
}
