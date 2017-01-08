<?php

namespace Adriatic\PHPAkademija\DesignPattern\State;

class Jumping implements State
{
    private $character;

    public function __construct(GameCharacter $character)
    {
        $this->character = $character;
    }

    public function stop() : string
    {
        $this->character->setState($this->character->getStandingState());

        return 'Stojim';
    }

    public function walk() : string
    {
        $this->character->setState($this->character->getWalkingState());

        return 'Hodam';
    }

    public function run() : string
    {
        $this->character->setState($this->character->getRunningState());

        return 'Trčim nakon skoka';
    }

    public function jump() : string
    {
        return 'Već sam u skoku';
    }
}
