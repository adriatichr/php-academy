<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintAccommodationName extends Constraint
{
    public $messageLetters = 'Ime smještaja mora sadržavati samo slova';
    public $messageSameName = 'Smještaj naziva "%string%" već postoji';
}
