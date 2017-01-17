<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Accommodation as EntityAccommodation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RestController extends Controller
{
    /**
     * @Route("/rest/accommodations/{accommodationId}", name="AppBundle_Rest_accommodation")
     * @Method({"GET"})
     */
    public function accommodationAction(Request $request, int $accommodationId)
    {
        $accommodation = $this->get('app.accommodation_repository')->findByIdWithPlace($accommodationId);

        if (!$accommodation) {
            return new JsonResponse(['error' => sprintf('Accommodation with id %s not found.', $accommodationId)], 404);
        }

        return JsonResponse::fromJsonString($this->renderView('AppBundle:Rest:accommodation.json.twig', [
            'accommodation' => $accommodation,
        ]));
    }

    /**
     * @Route("/rest/accommodations/{accommodationId}", name="AppBundle_Rest_accommodationDelete")
     * @Method("DELETE")
     */
    public function accommodationDeleteAction(Request $request, int $accommodationId)
    {
        $accommodation = $this->get('app.accommodation_repository')->findByIdWithPlace($accommodationId);

        if (!$accommodation) {
            return new JsonResponse(['error' => sprintf('Accommodation with id %s not found.', $accommodationId)], 404);
        }

        $this->getDoctrine()->getManager()->remove($accommodation);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(['success' => sprintf('Accommodation with id %s deleted', $accommodationId)]);
    }

    /**
     * @Route("/rest/accommodations", name="AppBundle_Rest_accommodationList")
     * @Method("GET")
     */
    public function accommodationListAction(Request $request)
    {
        $accommodations = $this->get('app.accommodation_repository')->findAll();

        return JsonResponse::fromJsonString($this->renderView('AppBundle:Rest:accommodationList.json.twig', [
            'accommodations' => $accommodations,
        ]));
    }
}
