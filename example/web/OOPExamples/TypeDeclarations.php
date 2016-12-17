<?php

// http://phpacademy.example.{inicijali}/web/OOPExamples/TypeDeclarations.php
require_once __DIR__.'/../../app/bootstrap.php';

use Adriatic\PHPAkademija\OOPIntro\TypeDeclarations\TypeFoo;

// Metode implicitIntegerConversion(), implicitStringConversion(), implicitFloatConversion(), implicitBoolConversion()
// definirane u TypeFoo samo vraćaju vrijednost koju su dobile kao ulazni parametar. Svrha je demonstrirati kako PHP vrši
// implicitnu konverziju ulaznog parametra u skalarni type hint (int, string, float i bool).
$foo = new TypeFoo();

echo '<h3>Implicitna konverzija u cijeli broj</h3>';
d('Ulazni parametar metode:', '5');
d('Vrijednost ulaznog parametra nakon implicitne konverzije:', $foo->implicitIntegerConversion('5'));
d('Ulazni parametar metode:', 5.0);
d('Vrijednost ulaznog parametra nakon implicitne konverzije:', $foo->implicitIntegerConversion(5.0));
d('Ulazni parametar metode:', true);
d('Vrijednost ulaznog parametra nakon implicitne konverzije:', $foo->implicitIntegerConversion(true));
d('Ulazni parametar metode:', false);
d('Vrijednost ulaznog parametra nakon implicitne konverzije:', $foo->implicitIntegerConversion(false));

echo '<h3>Implicitna konverzija u string</h3>';
d('Ulazni parametar metode:', 5);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitStringConversion(5));
d('Ulazni parametar metode:', 5.0);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitStringConversion(5.0));
d('Ulazni parametar metode:', true);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitStringConversion(true));
d('Ulazni parametar metode:', false);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitStringConversion(false));

echo '<h3>Implicitna konverzija u float</h3>';
d('Ulazni parametar metode:', 5);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitFloatConversion(5));
d('Ulazni parametar metode:', '5');
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitFloatConversion('5'));
d('Ulazni parametar metode:', true);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitFloatConversion(true));
d('Ulazni parametar metode:', false);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitFloatConversion(false));

echo '<h3>Implicitna konverzija u boolean</h3>';
d('Ulazni parametar metode:', 5);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitBoolConversion(5));
d('Ulazni parametar metode:', 0);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitBoolConversion(0));
d('Ulazni parametar metode:', 'true');
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitBoolConversion('true'));
d('Ulazni parametar metode:', 'false');
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitBoolConversion('false'));
d('Ulazni parametar metode:', '');
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitBoolConversion(''));
d('Ulazni parametar metode:', 0.0);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitBoolConversion(0.0));
d('Ulazni parametar metode:', 5.0);
d('Vrijednost ulaznog parametra nakon implicitne konverzije: ', $foo->implicitBoolConversion(5.0));
