<?php

namespace AppBundle\View;

use AppBundle\Repository\ReservationRepository;

class Availability
{
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function forAccommodationAndDate(int $accommodationId, int $month, int $year)
    {
        $startDate = \DateTimeImmutable::createFromFormat('Y-m-d', sprintf('%s-%s-01', $year, $month));
        $endDate = \DateTimeImmutable::createFromFormat('Y-m-d', sprintf('%s-%s-01', $year, $month + 1));

        $reservations = $this->reservationRepository->findForAccommodationByStartAndEndDate(
            $accommodationId, $startDate, $endDate);

        $reservedDates = [];
        foreach ($reservations as $reservation) {
            $reservationPeriod = new \DatePeriod(
                $reservation->getStartDate(),
                \DateInterval::createFromDateString('1 day'),
                $reservation->getEndDate());

            foreach ($reservationPeriod as $date) {
                $reservedDates[] = $date;
            }
        }

        return $reservedDates;
    }
}
