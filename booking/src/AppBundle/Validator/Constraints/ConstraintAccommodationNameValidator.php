<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Repository\AccommodationRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintAccommodationNameValidator extends ConstraintValidator
{
    private $accommodationRepository;

    public function __construct(AccommodationRepository $accommodationRepository)
    {
        $this->accommodationRepository = $accommodationRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$this->nameHasOnlyLetters($value)) {
            $this->context->buildViolation($constraint->messageLetters)
                ->addViolation();
        } elseif ($this->hasAccommodationByName($value)) {
            $this->context->buildViolation($constraint->messageSameName)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }

    private function nameHasOnlyLetters($name)
    {
        return preg_match('/^[a-zA-Z šđčćžŠĐČĆŽ]+$/', $name, $matches) ? true : false;
    }

    private function hasAccommodationByName($name)
    {
        return $this->accommodationRepository->findOneByName($name) ? true : false;
    }
}
