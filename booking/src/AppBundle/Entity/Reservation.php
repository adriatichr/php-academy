<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/** @ORM\Column(type="integer") */
	private $accommodationId;

	/** @ORM\Column(type="datetime") */
	private $startDate;

	/** @ORM\Column(type="datetime") */
	private $endDate;

	public function getStartDate()
	{
		return $this->startDate;
	}

	public function getEndDate()
	{
		return $this->endDate;
	}
}
