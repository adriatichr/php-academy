<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;

class AccommodationController extends Controller
{
    /**
     * @Route("/accommodation/{accommodationId}", name="AppBundle_Accommodation_accommodation")
     */
    public function accommodationAction($accommodationId)
    {
        $accommodationRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Accommodation');
        $accommodation = $accommodationRepository->findByIdWithPlace($accommodationId);

        $availability = $this->get('app.view.availability');
        $reservedDates = $availability->forAccommodationAndDate($accommodationId, 7, date('Y'));

        if(!$accommodation)
            throw $this->createNotFoundException(sprintf('Accommodation with id "%s" not found.', $accommodationId));

        return $this->render('AppBundle:Accommodation:accommodation.html.twig', [
            'accommodation' => $accommodation,
            'reservedDates' => $reservedDates,
        ]);
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

    /**
     * Akcija koja servira slike smještaja.
     *
     * Ako slika ne postoji, servira se no-image.jpg slika.
     *
     * @Route("/accommodation/image/main/{accommodationId}", name="AppBundle_Accommodation_mainImage")
     */
    public function mainImageAction(int $accommodationId)
    {
        $imagePath = '../src/AppBundle/Resources/images/accommodation/apartman' . $accommodationId . '.jpg';
        if(!file_exists($imagePath))
            $imagePath = '../src/AppBundle/Resources/images/accommodation/no-image.jpg';

        $response = new BinaryFileResponse($imagePath);
        $response->headers->set('Content-Type', 'image/jpeg');

        return $response;
    }

}
