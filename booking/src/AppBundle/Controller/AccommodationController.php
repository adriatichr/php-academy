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
use Symfony\Component\HttpFoundation\Response;

class AccommodationController extends Controller
{
    /**
     * @Route("/accommodation/{accommodationId}", name="AppBundle_Accommodation_accommodation")
     */
    public function accommodationAction($accommodationId)
    {
        $accommodation = $this->get('app.accommodation_repository')->findByIdWithPlace($accommodationId);

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
    public function accommodationListAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $form = $this->get('form.factory')->createNamed(null, SearchParametersType::class, new SearchParameters());
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $accommodations = $this->get('app.accommodation_repository')->findByParameters($form->getData());
        } else {
            $accommodations = $this->get('app.accommodation_repository')->findAll();
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
        $imagePath = __DIR__ . '/../Resources/images/accommodation/apartman' . $accommodationId . '.jpg';
        if(!file_exists($imagePath))
            $imagePath = __DIR__ . '/../Resources/images/accommodation/no-image.jpg';

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

        if($form->isSubmitted() && $form->isValid()) {
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

    /**
     * @Route("/admin/accommodation/{accommodationId}/edit/", name="AppBundle_Accommodation_accommodationEdit")
     */
    public function accommodationEditAction(int $accommodationId)
    {
        $accommodation = $this->get('app.accommodation_repository')->findByIdWithPlace($accommodationId);
        if(!$accommodation)
            throw $this->createNotFoundException('Smjestaj nije pronadjen');

        $this->denyAccessUnlessGranted('edit', $accommodation);

        return new Response('<html><body>Uređivanje smještaja</body></html>');
    }
    /**
     * @Route("/ajax/changeCalendar",
     *  name="AppBundle_Accommodation_accommodation_changeCalendar")
     */
    public function changeCalendarAction(Request $request)
    {
        $month = (int) $request->query->get('month');
        $year = (int) $request->query->get('year');
        $accommodationId = (int) $request->query->get('accommodationId');
        $availability = $this->get('app.view.availability');
        $reservedDates = $availability->forAccommodationAndDate($accommodationId, $month, $year);

        return $this->render('AppBundle:Accommodation:calendar.html.twig', [
            'month' => 7,
            'year' => date('Y'),
            'reservedDates' => $reservedDates,
        ]);
    }


}
