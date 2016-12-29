<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintPriceValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!empty($value->priceFrom) && !empty($value->priceTo)
            && $value->priceFrom>=$value->priceTo) {
            $this->context->buildViolation($constraint->message)
                ->atPath('priceFrom')
                ->addViolation();
        }
    }
}
