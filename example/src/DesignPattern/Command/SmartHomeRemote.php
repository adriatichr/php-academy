<?php

namespace Adriatic\PHPAkademija\DesignPattern\Command;

use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\NoCommand;

class SmartHomeRemote
{
    private $onCommands = [];
    private $offCommands = [];

    public function __construct()
    {
        for ($slot=0; $slot < 7; $slot++) {
            $this->onCommands[$slot] = new NoCommand();
            $this->offCommands[$slot] = new NoCommand();
        }
    }

    public function setCommand(int $slot, Command $onCommand, Command $offCommand)
    {
        if($slot > 6 || $slot < 0)
            throw new \InvalidArgumentException();

        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

    public function on(int $slot)
    {
        $this->onCommands[$slot]->execute();
    }

    public function off(int $slot)
    {
        $this->offCommands[$slot]->execute();
    }
}