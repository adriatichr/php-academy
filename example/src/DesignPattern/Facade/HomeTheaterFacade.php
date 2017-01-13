<?php

namespace Adriatic\PHPAkademija\DesignPattern\Facade;

class HomeTheaterFacade
{
    private $tv;
    private $bluRayPlayer;
    private $amp;

    public function __construct(Television $tv, BluRayPlayer $bluRayPlayer, Amplifier $amp)
    {
        $this->tv = $tv;
        $this->bluRayPlayer = $bluRayPlayer;
        $this->amp = $amp;
    }

    public function watchMovie($movieName)
    {
        $this->bluRayPlayer->on();
        $this->bluRayPlayer->insertMovie($movieName);
        $this->amp->on();
        $this->amp->setVolumeLevel(15);
        $this->tv->on();
        $this->tv->setSource('HDMI');
        $this->tv->setBrightness(60);
        $this->bluRayPlayer->play();
    }

    public function endMovie()
    {
        $this->bluRayPlayer->removeMovie();
        $this->bluRayPlayer->off();
        $this->tv->off();
        $this->amp->off();
    }
}
