<?php

namespace Adriatic\PHPAkademija\DesignPattern\State;

class GameCharacter
{
    private $standingState;
    private $walkingState;
    private $runningState;
    private $jumpingState;
    private $state;

    public function __construct()
    {
        $this->standingState = new Standing($this);
        $this->walkingState = new Walking($this);
        $this->runningState = new Running($this);
        $this->jumpingState = new Jumping($this);
        $this->state = $this->standingState;
    }

    public function stop() : string
    {
        return $this->state->stop();
    }

    public function walk() : string
    {
        return $this->state->walk();
    }

    public function run() : string
    {
        return $this->state->run();
    }

    public function jump() : string
    {
        return $this->state->jump();
    }

    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function getCurrentState() : State
    {
        return $this->state;
    }

    public function getRunningState() : State
    {
        return $this->runningState;
    }

    public function getWalkingState() : State
    {
        return $this->walkingState;
    }

    public function getJumpingState() : State
    {
        return $this->jumpingState;
    }

    public function getStandingState() : State
    {
        return $this->standingState;
    }
}
