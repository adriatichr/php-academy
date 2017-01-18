<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepositoryImpl")
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(type="integer") */
    private $accommodationId;

    /** @ORM\Column(type="datetime") */
    private $startDate;

    /** @ORM\Column(type="datetime") */
    private $endDate;

    public function __construct(int $accommodationId, \DateTimeImmutable $startDate, \DateTimeImmutable $endDate)
    {
        $this->accommodationId = $accommodationId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }
}
