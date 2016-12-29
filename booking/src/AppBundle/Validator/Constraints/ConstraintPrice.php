<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintPrice extends Constraint
{
    public $message = 'Cijena "Od" mora biti manja od cijene "Do"';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
