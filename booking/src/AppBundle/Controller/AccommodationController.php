<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Accommodation as EntityAccommodation;
use AppBundle\Form\Model\Accommodation as FormAccommodation;
use AppBundle\Form\Model\SearchParameters;
use AppBundle\Form\Type\AccommodationType;
use AppBundle\Form\Type\SearchParametersType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;

class AccommodationController extends Controller
{
    /**
     * @Route("/accommodation/{accommodationId}/{month}/{year}", name="AppBundle_Accommodation_accommodation")
     */
    public function accommodationAction($accommodationId, $month = null, $year = null) 
    {
        $now = new \DateTime('now');

        if ($year == null) {
            $year = $now->format('Y');
        }
        if ($month == null) {
            $month = $now->format('m');
        }

        $em = $this->getDoctrine()->getManager();
        $accommodation = $em->getRepository('AppBundle:Accommodation')
            ->findByIdWithPlace($accommodationId);
        
        if (!$accommodation)
            throw $this->createNotFoundException(sprintf('Accommodation with id "%s" not found.', $accommodationId));

        $availability = $this->get('app.view.availability');                       
        $reservedDates = $availability->forAccommodationAndDate($accommodationId, $month, $year);

        return $this->render('AppBundle:Accommodation:accommodation.html.twig', [
            'accommodation' => $accommodation,
            'reservedDates' => $reservedDates,
            'year' => $year,
            'month' => $month
        ]);
    }

    /**
     * @Route("/accommodation", name="AppBundle_Accommodation_accommodationList")
     */
    public function accommodationListAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $form = $this->get('form.factory')->createNamed(null, SearchParametersType::class, new SearchParameters());
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $accommodations = $manager->getRepository('AppBundle:Accommodation')->findByParameters($form->getData());
        } else {
            $accommodations = $manager->getRepository('AppBundle:Accommodation')->findAll();
        }

        return $this->render('AppBundle:Accommodation:accommodationList.html.twig', [
            'accommodations' => $accommodations,
            'form' => $form->createView(),
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

    /**
     * @Route("/admin/accommodation/add", name="AppBundle_Accommodation_accommodationAdd")
     */
    public function accommodationAddAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $formAccommodation = new FormAccommodation();
        $form = $this->createForm(AccommodationType::class, $formAccommodation);
        $form->handleRequest($request);
        $insert = false;

        if($form->isValid() && $form->isSubmitted()) {
            $formAccommodation = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $place = $entityManager->getRepository('AppBundle:Place')->findOneByName($formAccommodation->place);
            $accommodation = new EntityAccommodation();
            $accommodation->setName($formAccommodation->name);
            $accommodation->setCategory($formAccommodation->category);
            $accommodation->setPricePerDay($formAccommodation->pricePerDay);
            $accommodation->setPlace($place);

            $entityManager->persist($accommodation);
            $entityManager->flush();

            $insert = true;
        }

        return $this->render('AppBundle:Accommodation:accommodationAdd.html.twig', [
            'form' => $form->createView(),
            'insert' => $insert
        ]);
    }

}
