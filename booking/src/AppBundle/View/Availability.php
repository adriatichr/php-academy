<?php 

namespace AppBundle\View;

class Availability
{
	private $entityManager;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function forAccommodationAndDate(int $accommodationId, int $month, int $year)
	{
		$dql = 'SELECT r FROM AppBundle:Reservation AS r 
			WHERE r.accommodationId = :id AND r.startDate > :start AND r.endDate < :end';

		$startDate = \DateTimeImmutable::createFromFormat('Y-m-d', 
			sprintf('%s-%s-01', $year, $month));
		$endDate = \DateTimeImmutable::createFromFormat('Y-m-d', 
			sprintf('%s-%s-01', $year, $month + 1));

		$reservations = $this->entityManager
			->createQuery($dql)
			->setParameter('id', $accommodationId)
			->setParameter('start', $startDate)
			->setParameter('end', $endDate)
			->getResult();

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