<?php

namespace Adriatic\PHPAkademija\Test\TestDouble;

use Adriatic\PHPAkademija\TestDouble\LoginService;
use Adriatic\PHPAkademija\TestDouble\ReservationService;
use PHPUnit\Framework\TestCase;

class MockeryStubTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @test */
    public function customerCanBookReservationOnlyIfLoggedIn()
    {
        $loginService = \Mockery::mock(LoginService::class);
        $loginService->shouldReceive('isLoggedIn')->with(42)->andReturn(true);

        $reservationService = new ReservationService($loginService);

        $this->assertEquals('Smještaj 15 je bookiran', $reservationService->bookAccommodation(15, 42));
    }
}
