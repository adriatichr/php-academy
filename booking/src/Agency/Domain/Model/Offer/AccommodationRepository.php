<?php

namespace Agency\Domain\Model\Offer;

use AppBundle\Form\Model\SearchParameters;

interface AccommodationRepository
{
    public function findByIdWithPlace($id);

    public function findByParameters(SearchParameters $searchParameters);

    public function deleteAllWithName($name);
}
