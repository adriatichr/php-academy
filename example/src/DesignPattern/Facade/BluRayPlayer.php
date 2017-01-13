<?php

namespace Adriatic\PHPAkademija\DesignPattern\Facade;

class BluRayPlayer
{
    public function on()
    {
        echo 'Uključen blu ray player<br />';
    }

    public function insertMovie(string $movieName)
    {
        echo sprintf('Ubačen film "%s"<br />', $movieName);
    }

    public function play()
    {
        echo 'Počeo film<br />';
    }

    public function removeMovie()
    {
        echo 'Uklonjen film iz blu ray playera<br />';
    }

    public function off()
    {
        echo 'Isključen blu ray player<br />';
    }
}
