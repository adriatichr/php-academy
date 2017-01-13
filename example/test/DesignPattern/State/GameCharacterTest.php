<?php

namespace Adriatic\PHPAkademija\Test\DesignPattern\State;

use Adriatic\PHPAkademija\DesignPattern\State\GameCharacter;
use PHPUnit\Framework\TestCase;

class GameCharacterTest extends TestCase
{
    private $character;

    public function setUp()
    {
        $this->character = new GameCharacter();
    }

    /** @test */
    public function jumpThenRun()
    {
        $this->assertEquals('Skačem na mjestu', $this->character->jump());
        $this->assertEquals('Trčim nakon skoka', $this->character->run());
    }

    /** @test */
    public function walkWhenAlreadyWalking()
    {
        $this->character->walk();
        $this->assertEquals('Već hodam', $this->character->walk());
    }

    /** @test */
    public function runThenStop()
    {
        $this->character->run();
        $this->assertEquals('Usporavam u hod, stojim', $this->character->stop());
        $this->assertEquals('Već sam stao', $this->character->stop());
    }

    /** @test */
    public function stopWhenStanding()
    {
        $this->character->stop();
        $this->assertEquals('Već sam stao', $this->character->stop());
    }

    /** @test */
    public function stopAfterWalking()
    {
        $this->character->walk();
        $this->assertEquals('Stajem', $this->character->stop());
    }

    /** @test */
    public function jumpAfterWalking()
    {
        $this->character->walk();
        $this->assertEquals('Skačem prema naprijed', $this->character->jump());
        $this->assertEquals('Već sam u skoku', $this->character->jump());
    }

    /** @test */
    public function startWalking()
    {
        $this->assertEquals('Krećem u hod, hodam', $this->character->walk());
    }

    /** @test */
    public function stopAfterJump()
    {
        $this->character->jump();
        $this->assertEquals('Stojim', $this->character->stop());
    }

    /** @test */
    public function cannotJumpWhileJumping()
    {
        $this->character->jump();
        $this->assertEquals('Već sam u skoku', $this->character->jump());
    }

    /** @test */
    public function performLongJump()
    {
        $this->character->run();
        $this->assertEquals('Skačem daleko prema naprijed', $this->character->jump());
    }

    /** @test */
    public function takesTimeToRunFromStanding()
    {
        $this->assertEquals('Krećem u trk, trčim', $this->character->run());
    }
}
