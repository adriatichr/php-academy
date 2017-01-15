<?php

namespace Adriatic\PHPAkademija\Test\TestDouble;

use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution\ReservationServiceImpl;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution\ProviderNotifier;
use PHPUnit\Framework\TestCase;

class SpyTest extends TestCase
{
    /** @test */
    public function shouldNotifyProviderOfSuccessfulBooking()
    {
        $providerNotifier = new ProviderNotifierSpy();
        $reservationService = new ReservationServiceImpl($providerNotifier);

        $reservationService->bookAccommodation(15, 0);

        $this->assertEquals(15, $providerNotifier->getReceivedAccommodationId());
    }
}


class ProviderNotifierSpy implements ProviderNotifier
{
    private $receivedAccommodationId;

    public function askForConfirmation(int $accommodationId)
    {
        $this->receivedAccommodationId = $accommodationId;
    }

    public function getReceivedAccommodationId()
    {
        return $this->receivedAccommodationId;
    }
}
