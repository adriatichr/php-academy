<?php

// http://phpacademy.example.{inicijali}/OOPExamples/PassingByReference.php
require_once __DIR__.'/../../app/bootstrap.php';

/**
 * U PHP-u se argumenti u funkcije šalju po vrijednosti. Ovo znači da ako se argument izmjeni u funkciji, vrijednost
 * varijable koju smo poslali u funkciju kod poziva se neće promijeniti.
 *
 * Ovo vrijedi za skalarne tipove podataka (string, bool, int i float) i array. Za objekte vidjeti:
 * @see example\web\OOPExamples\ObjectsAndReferences.php
 *
 * @link http://php.net/manual/en/language.references.pass.php
 */
echo '<h3>Slanje argumenta po vrijednosti (passing by value)</h3>';
function foo(int $arg)
{
    $arg = 5;
    echo 'Vrijednost argumenta u funkciji foo() je postavljena na: ' . $arg . '<br />';
}
$a = 2;

echo 'Vrijednost varijable $a prije poziva funkcije foo() je: ' . $a . '<br />';
foo($a);
echo 'Vrijednost varijable $a nakon poziva funkcije foo() je i dalje: ' . $a . '<br />';


/**
 * PHP nam omogućava da varijable šaljemo po referenci tako da stavimo znak & prije argumenta funkcije. Slanje po
 * referenci znači da izmjena varijable unutar funkcije ostaje zapamćena i nakon njenog poziva.
 */
echo '<h3>Slanje argumenta po referenci (passing by reference)</h3>';
function bar(int & $arg)
{
    $arg = 5;
    echo 'Vrijednost argumenta u funkciji bar() je postavljena na: ' . $arg . '<br />';
}
$a = 2;

echo 'Vrijednost varijable $a prije poziva funkcije bar() je: ' . $a . '<br />';
bar($a);
echo 'Vrijednost varijable $a nakon poziva funkcije bar() je: ' . $a . '<br />';
