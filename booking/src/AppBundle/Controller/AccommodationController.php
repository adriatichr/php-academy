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
        $manager = $this->getDoctrine()->getManager();
        $accommodation = $manager->getRepository('AppBundle:Accommodation')->find($accommodationId);

        if(!$accommodation)
            throw $this->createNotFoundException(sprintf('Accommodation with id "%s" not found.', $accommodationId));

        return $this->render('AppBundle:Accommodation:accommodation.html.twig', ['accommodation' => $accommodation]);
    }

    /**
     * @Route("/accommodation", name="AppBundle_Accommodation_accommodationList")
     */
    public function accommodationListAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $accommodations = $manager->getRepository('AppBundle:Accommodation')->findAll();

        return $this->render('AppBundle:Accommodation:accommodationList.html.twig', [
            'accommodations' => $accommodations
        ]);
    }

}
