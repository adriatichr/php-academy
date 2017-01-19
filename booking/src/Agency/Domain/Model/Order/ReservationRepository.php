<?php

namespace Agency\Domain\Model\Order;

interface ReservationRepository
{
    public function findForAccommodationByStartAndEndDate(int $accommodationId, \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate) : array;
}
