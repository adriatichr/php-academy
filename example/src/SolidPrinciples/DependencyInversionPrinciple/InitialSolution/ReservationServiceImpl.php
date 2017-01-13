<?php

namespace Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\InitialSolution;

use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\Booking;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\ReservationManagment;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\SmsService;

class ReservationServiceImpl implements Booking, ReservationManagment
{
    public function bookAccommodation(int $accommodationId, int $customerId)
    {
        $smsService = new SmsService();
        $providerPhoneNumber = $this->getProviderPhoneNumber();
        $smsService->sendSms($providerPhoneNumber, 'Prihvaćate li rezervaciju smještaja?');

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

    private function getProviderPhoneNumber()
    {
        return '091 234 5678';
    }
}
