<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends Controller
{
    /**
     * @Route("/ajax/user-data", name="AppBundle_User_userData", condition="request.isXmlHttpRequest()")
     */
    public function userDataAction()
    {
        $userData = ['name' => false, 'surname' => false, 'loggedIn' => false];
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();
            $userData['name'] = $user->getName();
            $userData['surname'] = $user->getSurname();
            $userData['loggedIn'] = true;
        }

        return new JsonResponse($userData);
    }
}
