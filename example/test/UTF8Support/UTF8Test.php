<?php

namespace Adriatic\PHPAkademija\Test\UTF8Support;

use PHPUnit\Framework\TestCase;

class UTF8Test extends TestCase
{
    /** @test */
    public function strposAndUtf8Strings()
    {
        $this->assertNotEquals(1, strpos('čaj', 'a'), 'Slovo č je u UTF-8 encodingu zapisano pomoću 2 byte-a.');
        $this->assertSame(2, strpos('čaj', 'a'),
            'Kako je string u PHP-u zapravo polje byte-ova, ne polje znakova, pozicija slova a je 3. byte. (Index ide od 0)');
        $this->assertSame(1, mb_strpos('čaj', 'a'),
            'Za manipulaciju sa UTF-8 stringovima moramo koristiti PHP multibyte (mb_*) funkcije.');
    }

    /** @test */
    public function strlenAndUtf8Strings()
    {
        $this->assertSame(10, strlen('čćžšđ'), 'strlen broji byte-ove u stringu, ne znakove');
        $this->assertSame(5, mb_strlen('čćžšđ'), 'mb_strlen broji znakove u stringu');
    }

    /** @test */
    public function utf8EncodingInDoubleQuotedStrings()
    {
        $this->assertEquals('A', "\u{41}");
        $this->assertEquals('X', "\u{58}");
        $this->assertEquals(' ', "\u{20}", 'space znak');
    }

    /** @test */
    public function internalPHPEncoding()
    {
        $this->assertSame('UTF-8', mb_internal_encoding());
    }

    /** @test */
    public function strReplaceWorksNormallyBecauseItReplacesSequencesOfBytes()
    {
        $this->assertSame('čaj', str_replace('ž', 'č', 'žaj'));
    }

    /** @test */
    public function ucfirstHasNoEffectIfFirstLetterIsNonAsciiCharacter()
    {
        $this->assertSame('čaj', ucfirst('čaj'));
        $this->assertNotEquals('Čaj', ucfirst('čaj'));
    }
}
