<?php

use PHPUnit\Framework\TestCase;

# Ako klasu spominjemo više puta u istom file-u, možemo na vrhu koristiti *use* statement kako bi smo PHP-u rekli na koju
# klasu A mislimo. Sada kad u fileu koristimo klasu A PHP će znati da se radi o klasi \Adriatic\A.
use Adriatic\A;
# Na isti način možemo koristiti i klasu Symfony\A ali kako smo već definirali da se A odnosi na \Adriatic\A, za klasu
# \Symfony\A moramo koristiti tzv. alias, tj. definirati ime pod kojim ćemo je referencirati u ovom file-u.
use Symfony\A as SymfonyA;

class AliasTest extends TestCase
{
    /** @test */
    public function usingAlias()
    {
        require_once __DIR__ . '/../../../src/OOPIntro/NamespaceExample/Adriatic/A.php';
        require_once __DIR__ . '/../../../src/OOPIntro/NamespaceExample/Symfony/A.php';

        $a1 = new A();
        $this->assertEquals('Random Adriatic related stuff', $a1->getAdriaticRelatedStuff());

        $a2 = new SymfonyA();
        $this->assertEquals('Random Symfony related stuff', $a2->getSymfonyRelatedStuff());
    }
}
