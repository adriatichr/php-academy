<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\Command;

use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\CoolingOffCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\CoolingOnCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\HeatingOffCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\HeatingOnCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\LightOffCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\LightOnCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\MacroCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\ConcreteCommand\NoCommand;
use Adriatic\PHPAkademija\DesignPattern\Command\Receiver\AirCon;
use Adriatic\PHPAkademija\DesignPattern\Command\Receiver\Light;
use Adriatic\PHPAkademija\DesignPattern\Command\SmartHomeRemote;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    private $smartHomeRemote;

    public function setUp()
    {
        $this->smartHomeRemote = new SmartHomeRemote();
    }

    /** @test */
    public function turnLightsOnAndOff()
    {
        $light = new Light();
        $lightOnCommand = new LightOnCommand($light);
        $lightOffCommand = new LightOffCommand($light);
        $this->smartHomeRemote->setCommand(0, $lightOnCommand, $lightOffCommand);

        $this->expectOutputString("Uključeno svjetlo\nIsključeno svjetlo\n");
        $this->smartHomeRemote->on(0);
        $this->smartHomeRemote->off(0);
    }

    /** @test */
    public function turnCoolingOnAndOff()
    {
        $airCon = new AirCon();
        $coolingOnCommand = new CoolingOnCommand($airCon, 23);
        $coolingOffCommand = new CoolingOffCommand($airCon);
        $this->smartHomeRemote->setCommand(6, $coolingOnCommand, $coolingOffCommand);

        $this->expectOutputString("Uključeno hlađenje na 23C\nIsključeno hlađenje\n");
        $this->smartHomeRemote->on(6);
        $this->smartHomeRemote->off(6);
    }

    /** @test */
    public function lightsAndHeatingMacroCommand()
    {
        $airCon = new AirCon();
        $light = new Light();
        $heatingOnCommand = new HeatingOnCommand($airCon, 26);
        $heatingOffCommand = new HeatingOffCommand($airCon);
        $lightOnCommand = new LightOnCommand($light);
        $lightOffCommand = new LightOffCommand($light);

        $macroOnCommand = new MacroCommand([$lightOnCommand, $heatingOnCommand]);
        $macroOffCommand = new MacroCommand([$lightOffCommand, $heatingOffCommand]);
        $this->smartHomeRemote->setCommand(0, $macroOnCommand, $macroOffCommand);

        $this->expectOutputString("Uključeno svjetlo\nUključeno grijanje na 26C\nIsključeno svjetlo\nIsključeno grijanje\n");
        $this->smartHomeRemote->on(0);
        $this->smartHomeRemote->off(0);
    }

    /**
     * @testWith [-1]
     *           [7]
     *           [8]
     *           [1500]
     */
    public function cannotSetCommandInInvalidSlot($invalidSlot)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->smartHomeRemote->setCommand($invalidSlot, new NoCommand(), new NoCommand());
    }
}
