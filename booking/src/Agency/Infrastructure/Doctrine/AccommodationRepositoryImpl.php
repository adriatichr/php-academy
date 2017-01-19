<?php

namespace Agency\Infrastructure\Doctrine;

use Agency\Domain\Model\Offer\AccommodationRepository;
use AppBundle\Form\Model\SearchParameters;
use Doctrine\ORM\EntityRepository;

class AccommodationRepositoryImpl extends EntityRepository implements AccommodationRepository
{
    public function findByIdWithPlace($id)
    {
        $dql = 'SELECT a, p FROM Agency\Domain\Model\Offer\Accommodation AS a JOIN a.place AS p WHERE a.id = :id';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function findByParameters(SearchParameters $searchParameters)
    {
        $dql = 'SELECT a, p FROM Agency\Domain\Model\Offer\Accommodation AS a JOIN a.place AS p';
        $where = [];
        $parameters = [];
        if (!empty($searchParameters->priceFrom)) {
            $where[] = ' a.pricePerDay >= :price_from ';
            $parameters['price_from'] = $searchParameters->priceFrom;
        }
        if (!empty($searchParameters->priceTo)) {
            $where[] = ' a.pricePerDay <= :price_to ';
            $parameters['price_to'] = $searchParameters->priceTo;
        }
        if (!empty($searchParameters->place)) {
            $where[] = ' p.id = :place_id ';
            $parameters['place_id'] = $searchParameters->place;
        }
        if ($where) {
            $dql .= " WHERE " . implode(' AND ', $where) . " ";
        }
        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters($parameters)
            ->getResult();
    }

    public function deleteAllWithName($name)
    {
        $dql = 'DELETE FROM Agency\Domain\Model\Offer\Accommodation a WHERE a.name = :name';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('name', $name)
            ->execute();
    }
}
