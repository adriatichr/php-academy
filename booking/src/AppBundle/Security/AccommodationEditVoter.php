<?php

namespace AppBundle\Security;

use AppBundle\Entity\Accommodation;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AccommodationEditVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, ['edit'])) {
            return false;
        }

        if (!$subject instanceof Accommodation) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $accommodation = $subject;
        $accommodationOwner = $accommodation->getOwner();

        if (!$accommodationOwner) {
            return false;
        }

        if ($accommodationOwner->getUsername() == $user->getUsername()) {
            return true;
        }

        return false;
    }
}
