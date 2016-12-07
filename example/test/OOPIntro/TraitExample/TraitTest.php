<?php

use Adriatic\PHPAkademija\OOPIntro\TraitExample\Employee;
use Adriatic\PHPAkademija\OOPIntro\TraitExample\Manager;
use PHPUnit\Framework\TestCase;

# Počinjemo sa Employee klasom koja ima metodu za postavljanje plaće, a nasljeđuje Person klasu i Manager klasom koja
# nasljeđuje Employee klasu (iz primjera sa nasljeđivanjima).
# Napravimo PoliteTrait i implementiramo ga (sayHello() metoda) u Employee klasi
# Napravimo RudeTrait i implementiramo ga (sayHello() metoda) u Manager klasi. Primjetiti kako se u ovom slučaju
# overridea sayHello() od Employee nadklase.
#
# Trait može pozivati neku metodu iz klase u kojoj se uključuje: Introduction trait
# (možemo isti trait koristiti u Manager klasi i dobiti ćemo drugačiji rezultat metode getFullName())
class TraitTest extends TestCase
{
    /** @test */
    public function employeeIsPolite()
    {
        $employee = new Employee('Ana', 'Anić');
        $this->assertEquals('Hello, nice to meet you.', $employee->sayHello());
    }

    /** @test */
    public function managerIsAngry()
    {
        $manager = new Manager('Šime', 'Šimić');
        $this->assertEquals('Go to hell.', $manager->sayHello());
    }

    /** @test */
    public function employeeCanIntroduceHimself()
    {
        $employee = new Employee('John', 'Smith');
        $this->assertEquals('Hello, I am John Smith', $employee->introduceYourself());
    }
}
