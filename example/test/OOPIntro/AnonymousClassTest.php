<?php

use PHPUnit\Framework\TestCase;

use Adriatic\PHPAkademija\OOPIntro\InterfaceExample\Driveable;
use Adriatic\PHPAkademija\OOPIntro\TypeDeclarations\Driver;

class AnonymousClassTest extends TestCase
{
    /** @test */
    public function anonymousClassExample()
    {
        $driver = new Driver();
        $driver->getInACar(new class implements Driveable {
            public function steerLeft() : string
            {
                return 'Anonimni auto ide lijevo';
            }

            public function steerRight() : string
            {
                return 'Anonimni auto ide desno';
            }

            public function driveForward() : string
            {
                return 'Anonimni auto vozi naprid';
            }

            public function brake()
            {
            }

            public function driveReverse()
            {
            }
        });

        $this->assertSame([
            'Anonimni auto vozi naprid',
            'Anonimni auto ide lijevo',
            'Anonimni auto vozi naprid',
            'Anonimni auto ide lijevo',
            'Anonimni auto vozi naprid',
            'Anonimni auto ide lijevo',
            'Anonimni auto vozi naprid',
            'Anonimni auto ide lijevo',
        ], $driver->driveInCircles(1));
    }
}
