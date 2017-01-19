<?php

namespace AppBundle\Controller;

use Agency\Domain\Model\Offer\Accommodation;
use Agency\Domain\Model\Order\Reservation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dio URL-a rute koji je zajednički za sve akcije u kontroleru možemo konfigurirati ovdje.
 *
 * @Route("/api")
 */
class RestController extends Controller
{
    /**
     * @Route("/accommodation/{accommodationId}", name="AppBundle_Rest_accommodation")
     * @Method({"GET"})
     */
    public function accommodationAction(Request $request, int $accommodationId)
    {
        $accommodation = $this->get('app.accommodation_repository')->findByIdWithPlace($accommodationId);

        if (!$accommodation) {
            return new JsonResponse(null, 404);
        }

        return new JsonResponse($this->mapAccommodationToJson($accommodation));
    }

    /**
     * Akcija koja briše smještaj.
     *
     * Naravno, zbog jednostavnosti primjera izostavljene su razne sigurnosne provjere, npr. autorizacija.
     *
     * @Route("/accommodation/{accommodationId}", name="AppBundle_Rest_accommodationDelete")
     * @Method("DELETE")
     */
    public function accommodationDeleteAction(Request $request, int $accommodationId)
    {
        $accommodation = $this->get('app.accommodation_repository')->findByIdWithPlace($accommodationId);

        if (!$accommodation) {
            return new JsonResponse(null, 404);
        }

        $this->getDoctrine()->getManager()->remove($accommodation);
        $this->getDoctrine()->getManager()->flush();

        // Kod uspješne DELETE akcije Response nema sadržaja pa šaljemo status kôd 204 No Content
        return new JsonResponse(null, 204);
    }

    /**
     * @Route("/accommodation/{accommodationId}/availability", name="AppBundle_Rest_accommodationAvailability")
     * @Method("GET")
     */
    public function accommodationAvailabilityAction(Request $request, int $accommodationId)
    {
        $accommodation = $this->get('app.accommodation_repository')->findByIdWithPlace($accommodationId);

        if (!$accommodation) {
            return new JsonResponse(null, 404);
        }

        $availability = $this->get('app.view.availability');
        $reservedDates = $availability->forAccommodationAndDate($accommodationId, 7, date('Y'));
        $jsonAvailiability = [];
        foreach ($this->generateDatesForMonth(7, date('Y')) as $date) {
            if(in_array($date, $reservedDates)) {
                $jsonAvailiability[] = ['date' => $date->format('Y-m-d'), 'reserved' => true];
            } else {
                $jsonAvailiability[] = ['date' => $date->format('Y-m-d'), 'reserved' => false];
            }
        }

        return new JsonResponse(['availability' => $jsonAvailiability]);
    }

    /**
     * Jednostavni primjer patch-a za označavanje nedostupnih datuma na stranici dostupnosti smještaja.
     *
     * Naravno, zbog jednostavnosti izostavljene su razne provjere, npr. autorizacija, zaštita od više poziva sa istim
     * sadržajem patcha odjednom, provjera formata sadržaja patcha, itd...
     *
     * @Route("/accommodation/{accommodationId}/availability", name="AppBundle_Rest_accommodationPatchAvailability")
     * @Method("PATCH")
     */
    public function accommodationAvailabilityPatchAction(Request $request, int $accommodationId)
    {
        $patch = json_decode($request->getContent());

        if($patch->status === 'unavailable') {
            $reservation = new Reservation(
                $accommodationId, new \DateTimeImmutable($patch->start_date), new \DateTimeImmutable($patch->end_date)
            );
            $this->getDoctrine()->getManager()->persist($reservation);
            $this->getDoctrine()->getManager()->flush();
        }

        // Kod uspješne PATCH akcije Response nema sadržaja pa šaljemo status kôd 204 No Content
        return new JsonResponse(null, 204);
    }

    /**
     * @Route("/accommodation", name="AppBundle_Rest_accommodationList")
     * @Method("GET")
     */
    public function accommodationListAction(Request $request)
    {
        $accommodations = $this->get('app.accommodation_repository')->findAll();

        $jsonAccommodations = [];
        foreach ($accommodations as $accommodation) {
            $jsonAccommodations[] = $this->mapAccommodationToJson($accommodation);
        }

        return new JsonResponse(['accommodation' => $jsonAccommodations]);
    }

    private function mapAccommodationToJson(Accommodation $accommodation)
    {
        return [
            'name' => $accommodation->getName(),
            'category' => $accommodation->getCategory(),
            'description' => $accommodation->getDescription(),
            'place' => $accommodation->getPlace()->getName(),
            'pricePerDay' => $accommodation->getPricePerDay(),
            'links' => [
                'self' => $this->generateUrl('AppBundle_Rest_accommodation', [
                    'accommodationId' => $accommodation->getId(),
                ]),
                'availability' => $this->generateUrl('AppBundle_Rest_accommodationAvailability', [
                    'accommodationId' => $accommodation->getId(),
                ]),
            ],
        ];
    }

    private function generateDatesForMonth(int $month, int $year)
    {
        $startDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s-%s-01 00:00:00', $year, $month));
        $endDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s-%s-01 00:00:00', $year, $month + 1));

        $monthPeriod = new \DatePeriod(
            $startDate,
            \DateInterval::createFromDateString('1 day'),
            $endDate);

        $datesInMonth = [];
        foreach ($monthPeriod as $date) {
            $datesInMonth[] = $date;
        }

        return $datesInMonth;
    }
}
