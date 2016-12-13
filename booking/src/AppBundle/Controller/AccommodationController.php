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
        $queryBuilder = $this->get('database_connection')->createQueryBuilder();
        $statement = $queryBuilder
            ->select('a.*', 'p.name AS place_name')
            ->from('accommodation', 'a')
            ->join('a', 'place', 'p', 'p.id = a.place_id')
            ->where('a.id = ?')
            ->setParameter(0, $accommodationId)
            ->execute();
        $accommodation = $statement->fetch();
        if(!$accommodation)
            throw $this->createNotFoundException(sprintf('Accommodation with id "%s" not found.', $accommodationId));

        return $this->render('AppBundle:Accommodation:accommodation.html.twig', ['accommodation' => $accommodation]);
    }

    /**
     * @Route("/accommodation", name="AppBundle_Accommodation_accommodationList")
     */
    public function accommodationListAction()
    {
        $conn = $this->get('database_connection');
        $statement = $conn->query('SELECT * FROM accommodation');

        return $this->render('AppBundle:Accommodation:accommodationList.html.twig', [
            'accommodations' => $statement->fetchAll()
        ]);
    }

}
