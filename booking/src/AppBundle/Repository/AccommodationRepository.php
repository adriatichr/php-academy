<?php

namespace AppBundle\Repository;

use AppBundle\Form\Model\SearchParameters;
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

    public function findByParameters(SearchParameters $searchParameters)
    {
        $dql = 'SELECT a, p FROM AppBundle:Accommodation AS a JOIN a.place AS p';
        $where = [];
        $parameters = [];
        if (!empty($searchParameters->priceFrom)){
            $where[] = ' a.pricePerDay >= :price_from ';
            $parameters['price_from'] = $searchParameters->priceFrom;
        }
        if (!empty($searchParameters->priceTo)){
            $where[] = ' a.pricePerDay <= :price_to ';
            $parameters['price_to'] = $searchParameters->priceTo;
        }
        if (!empty($searchParameters->place)){
            $where[] = ' p.id = :place_id ';
            $parameters['place_id'] = $searchParameters->place;
        }
        if ($where){
            $dql .= " WHERE " . implode(' AND ', $where) . " ";
        }
        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters($parameters)
            ->getResult();
    }
}
