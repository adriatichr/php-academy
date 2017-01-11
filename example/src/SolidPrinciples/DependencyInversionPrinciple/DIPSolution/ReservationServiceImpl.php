<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution;

use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\Booking;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\ReservationManagment;

class ReservationServiceImpl implements Booking, ReservationManagment
{
    private $providerNotifier;

    public function __construct(ProviderNotifier $providerNotifier)
    {
        $this->providerNotifier = $providerNotifier;
    }

    public function bookAccommodation(int $accommodationId, int $customerId)
    {
        $this->providerNotifier->askForConfirmation($accommodationId);

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
