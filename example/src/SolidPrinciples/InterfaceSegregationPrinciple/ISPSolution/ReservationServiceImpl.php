<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\InterfaceSegregationPrinciple\ISPSolution;

class ReservationServiceImpl implements Booking, ReservationManagment
{
    public function bookAccommodation(int $accommodationId, int $customerId)
    {
        return sprintf('Pravimo zahtjev za rezervacijom smještaja "%s" za kupca "%s"', $accommodationId, $customerId);
    }

    public function acceptReservation(int $reservationId)
    {
        return sprintf('Prihvaćamo zahtjev za rezervacijom "%s" smještaja za korisnika', $reservationId);
    }

    public function refuseReservation(int $reservationId)
    {
        return sprintf('Odbijamo zahtjev za rezervacijom "%s" smještaja za korisnika', $reservationId);
    }
}
