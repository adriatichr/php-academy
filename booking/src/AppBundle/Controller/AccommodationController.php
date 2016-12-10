<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccommodationController extends Controller
{
    /**
     * @Route("/accommodation/{accommodationId}", name="AppBundle_Accommodation_accommodation")
     */
    public function accommodationAction($accommodationId)
    {
        return $this->render('AppBundle:Accommodation:accommodation.html.twig', [
            'id' => $accommodationId
        ]);
    }
}
