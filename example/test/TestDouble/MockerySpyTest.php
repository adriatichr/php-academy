<?php

namespace Adriatic\PHPAkademija\Test\TestDouble;

use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution\ProviderNotifier;
use Adriatic\PHPAkademija\SolidPrinciples\DependencyInversionPrinciple\DIPSolution\ReservationServiceImpl;
use PHPUnit\Framework\TestCase;

class MockerySpyTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @test */
    public function shouldNotifyProviderOfSuccessfulBooking()
    {
        $providerNotifier = \Mockery::mock(ProviderNotifier::class);
        $providerNotifier->shouldReceive('askForConfirmation')->with(15)->once();
        $reservationService = new ReservationServiceImpl($providerNotifier);

        $reservationService->bookAccommodation(15, 0);
    }
}
