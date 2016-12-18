<?php

// http://phpacademy.example.{inicijali}/web/OOPExamples/ObjectsAndReferences.php
require_once __DIR__.'/../../app/bootstrap.php';

/**
 * U PHP-u referenca je alias, što omogućava da dvije različite varijable mijenjaju istu vrijednost.
 *
 * Varijabla kojoj smo dodijelili neki objekt ne sadrži taj objekt, nego identifikator po kojem se objekt može pronaći.
 * Varijable objekata se također šalju u funkcije po vrijednosti, ali kako je ta vrijednost identifikator koji samo
 * pokazuje na objekt, ovo znači da će objekt izmijenjen unutar funkcije ostati izmijenjen i nakon njenog poziva.
 *
 * @link http://php.net/manual/en/language.oop5.references.php
 */
class A
{
    public $bar;
}

echo '<h3>Slanje objekta po referenci</h3>';
function foo(A $arg)
{
    $arg->bar = 10;
    echo 'Vrijednost $bar property-ja funkciji foo() je postavljena na: ' . $arg->bar . '<br />';
}

$a = new A();
$a->bar = 5;

echo 'Vrijednost $bar property-ja prije poziva funkcije foo() je: ' . $a->bar . '<br />';
foo($a);
echo 'Vrijednost $bar property-ja nakon poziva funkcije foo() je: ' . $a->bar . '<br />';


echo '<h3>Pridjeljivanje objekta po referenci</h3>';
/**
 * Također, ako u varijablu $b pridjelimo objekt $a, zapravo smo PHP-u rekli da i $a i $b pokazuju na isti objekt.
 */
$b = $a;

echo 'Vrijednost $bar property-ja objekta $a je: ' . $a->bar . '<br />';
echo 'Vrijednost $bar property-ja objekta $b je: ' . $b->bar . '<br />';
$b->bar = 15;
echo 'Vrijednost $bar property-ja objekta $a nakon promjene istog u varijabli $b je: ' . $a->bar . '<br />';
