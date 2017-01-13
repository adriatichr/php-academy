<?php

namespace Adriatic\PHPAkademija\Test\SolidPrinciples\InterfaceSegregationPrinciple\OriginalSolution;

use Adriatic\PHPAkademija\SolidPrinciples\InterfaceSegregationPrinciple\ISPSolution\ReservationServiceImpl;
use PHPUnit\Framework\TestCase;

class ISPSolutionTest extends TestCase
{
    public function setUp()
    {
        $this->reservationService = new ReservationServiceImpl();
    }

    /** @test */
    public function bookAccommodationUsingReservationService()
    {
        $this->assertEquals(
            'Pravimo zahtjev za rezervacijom smještaja "1" za kupca "42"',
            $this->reservationService->bookAccommodation(/* Accommodation id is */1, /* Customer id is */42)
        );
    }

    /** @test */
    public function acceptAndDenyReservationUsingReservationService()
    {
        $this->assertEquals(
            'Prihvaćamo zahtjev za rezervacijom "15" smještaja za korisnika',
            $this->reservationService->acceptReservation(15)
        );
        $this->assertEquals(
            'Odbijamo zahtjev za rezervacijom "20" smještaja za korisnika',
            $this->reservationService->refuseReservation(20)
        );
    }
}
