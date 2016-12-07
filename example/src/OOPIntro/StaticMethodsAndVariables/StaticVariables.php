<?php

function selfCallCounting()
{
    static $callCount = 0;
    $callCount++;

    return 'Funkcija pozvana ' . $callCount . ' puta.';
}
