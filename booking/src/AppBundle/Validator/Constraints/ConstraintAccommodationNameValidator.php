<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintAccommodationNameValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[a-zA-Z šđčćžŠĐČĆŽ]+$/', $value, $matches)) {
            $this->context->buildViolation($constraint->messageLetters)
                ->addViolation();
        } elseif ($this->hasAccommodationByName($value)) {
            $this->context->buildViolation($constraint->messageSameName)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }

    private function hasAccommodationByName($name)
    {
        return $this->entityManager->getRepository('AppBundle:Accommodation')->findOneByName($name) ? true : false;
    }
}
