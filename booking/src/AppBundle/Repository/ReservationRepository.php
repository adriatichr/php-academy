<?php

namespace AppBundle\Repository;

interface ReservationRepository
{
    public function findForAccommodationByStartAndEndDate(int $accommodationId, \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate) : array;
}
