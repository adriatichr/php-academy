<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ReservationRepositoryImpl extends EntityRepository implements ReservationRepository
{
    public function findForAccommodationByStartAndEndDate(int $accommodationId, \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate) : array
    {
        // Slučajevi koje moramo pokriti sa queryjem (puna crta je ciljani mjesec):
        // ---------_________________--------
        //       [     ]
        //             [    ]
        //                       [      ]
        //     [                          ]
        //
        $dql = 'SELECT r FROM AppBundle:Reservation AS r
            WHERE r.accommodationId = :id
            AND (
                (r.startDate >= :start AND r.startDate < :end)
                OR (r.endDate > :start AND r.endDate <= :end)
                OR (r.startDate < :start AND r.endDate > :end)
            )';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $accommodationId)
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getResult();
    }
}
