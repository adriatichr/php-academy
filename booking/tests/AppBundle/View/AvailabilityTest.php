<?php

namespace Tests\AppBundle\View;

use Agency\Domain\Model\Order\Reservation;
use Agency\Domain\Model\Order\ReservationRepository;
use AppBundle\View\Availability;
use PHPUnit\Framework\TestCase;

class AvailabilityTest extends TestCase
{
    const ACCOMMODATION_ID = 42;

    public function setUp()
    {
        $this->reservationRepository = new ReservationRepositoryStub();
        $this->availability = new Availability($this->reservationRepository);
    }

    /** @test */
    public function shouldReturnEmptyArrayIfNoReservationsForGivenAccommodationAndMonth()
    {
        $reserverdDates =  $this->availability->forAccommodationAndDate(self::ACCOMMODATION_ID, 7, 2015);
        $this->assertSame([], $reserverdDates);
    }

    /** @test */
    public function shouldReturnStartDateForOneDayReservationInsideRequestedMonth()
    {
        $this->reservationRepository->findForAccommodationByStartAndEndDate_shouldReturn([
            $this->reservation('12.07.2015', '13.07.2015'),
        ]);

        $reserverdDates = $this->availability->forAccommodationAndDate(self::ACCOMMODATION_ID, 7, 2015);

        $this->assertEquals([new \DateTimeImmutable('12.07.2015')], $reserverdDates);
    }

    /** @test */
    public function shouldReturnDatesForSeveralDaysReservationInsideRequestedMonth()
    {
        $this->reservationRepository->findForAccommodationByStartAndEndDate_shouldReturn([
            $this->reservation('12.07.2015', '15.07.2015'),
        ]);

        $reserverdDates = $this->availability->forAccommodationAndDate(self::ACCOMMODATION_ID, 7, 2015);

        $this->assertEquals([
            new \DateTimeImmutable('12.07.2015'),
            new \DateTimeImmutable('13.07.2015'),
            new \DateTimeImmutable('14.07.2015'),
        ], $reserverdDates);
    }

    /**
     * @testWith ["12.06.2015", "15.06.2015"]
     *           ["12.08.2015", "15.08.2015"]
     */
    public function shouldIgnoreReservationDatesOutsideRequestedMonth(string $startDate, string $endDate)
    {
        $this->reservationRepository->findForAccommodationByStartAndEndDate_shouldReturn([
            $this->reservation($startDate, $endDate),
        ]);
        $reserverdDates = $this->availability->forAccommodationAndDate(self::ACCOMMODATION_ID, 7, 2015);
        $this->assertSame([], $reserverdDates);
    }

    /**
     * @testWith ["30.06.2015", "02.07.2015", "01.07.2015"]
     *           ["31.07.2015", "02.08.2015", "31.07.2015"]
     */
    public function shouldReturnDatesFromRequestedMonthForSeveralMonthSpanningReservation(string $startDate,
        string $endDate, string $reservedDate)
    {
        $this->reservationRepository->findForAccommodationByStartAndEndDate_shouldReturn([
            $this->reservation($startDate, $endDate),
        ]);
        $reserverdDates = $this->availability->forAccommodationAndDate(self::ACCOMMODATION_ID, 7, 2015);
        $this->assertEquals([new \DateTimeImmutable($reservedDate)], $reserverdDates);
    }

    /** @test */
    public function correctParametersPassedToReservationRepository()
    {
        $this->availability->forAccommodationAndDate(self::ACCOMMODATION_ID, 2, 2016);
        $this->assertEquals([
            self::ACCOMMODATION_ID,
            new \DateTimeImmutable('01-02-2016'),
            new \DateTimeImmutable('01-03-2016'),
        ], $this->reservationRepository->getInputParameters());
    }

    private function reservation(string $startDate, string $endDate)
    {
        return new Reservation(100, new \DateTimeImmutable($startDate), new \DateTimeImmutable($endDate));
    }
}


class ReservationRepositoryStub implements ReservationRepository
{
    private $reservationsToReturn = [];
    private $findForAccommodationByStartAndEndDate_inputParameters;

    public function findForAccommodationByStartAndEndDate_shouldReturn(array $reservations)
    {
        $this->reservationsToReturn = $reservations;
    }

    public function getInputParameters() : array
    {
        return $this->findForAccommodationByStartAndEndDate_inputParameters;
    }

    public function findForAccommodationByStartAndEndDate(int $accommodationId, \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate) : array
    {
        $this->findForAccommodationByStartAndEndDate_inputParameters = [$accommodationId, $startDate, $endDate];

        return $this->reservationsToReturn;
    }
}
