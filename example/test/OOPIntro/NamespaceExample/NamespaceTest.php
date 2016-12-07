<?php

use PHPUnit\Framework\TestCase;

# Problem:
# Recimo da na početku u Adriatic source kôdu postoji klasa A.
# Kako bi olakšali održavanje odlučimo da ćemo koristiti Symfony framework.
# Ali i Symfony ima klasu A, i ako ih obje pokušamo koristiti u isto vrijeme Php će javiti Fatal error
#
# Rješenje:
# Php namespace - svaka od ovih klasa biti će definirana unutar posebnog namespace-a
class NamespaceTest extends TestCase
{
    /** @test */
    public function everythingIsAwesomeWithNamespaces()
    {
        require_once __DIR__ . '/../../../src/OOPIntro/NamespaceExample/Adriatic/A.php';
        require_once __DIR__ . '/../../../src/OOPIntro/NamespaceExample/Symfony/A.php';

        $a1 = new Adriatic\A();
        $this->assertEquals('Random Adriatic related stuff', $a1->getAdriaticRelatedStuff());

        $a2 = new Symfony\A();
        $this->assertEquals('Random Symfony related stuff', $a2->getSymfonyRelatedStuff());
    }

    /** @test */
    public function nameCollisionWithoutNamespaces()
    {
        // Zakomentirati ovu liniju za demonstraciju
        $this->markTestSkipped('Uključiti ovaj test za demonstraciju name collision-a.');

        require __DIR__ . '/../../../src/OOPIntro/NamespaceExample/Adriatic/NoNamespaceA.php';
        require __DIR__ . '/../../../src/OOPIntro/NamespaceExample/Symfony/NoNamespaceA.php';
    }
}
