<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AccommodationRepository extends EntityRepository
{
    public function findByIdWithPlace($id)
    {
        $dql = 'SELECT a, p FROM AppBundle:Accommodation AS a JOIN a.place AS p WHERE a.id = :id';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }
}
