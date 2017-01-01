<?php

namespace AppBundle\Controller;

use AppBundle\Form\Model\User;
use AppBundle\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class ExampleController extends Controller
{
    /**
     * @Route("/example/accommodation/insert")
     */
    public function storingAccommodationAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $place = $entityManager->getRepository('AppBundle:Place')->findOneByName('Split');
        $accommodation = new \AppBundle\Entity\Accommodation();
        $accommodation->setName('orm test');
        $accommodation->setCategory(4);
        $accommodation->setPricePerDay(99.99);
        $accommodation->setPlace($place);

        $entityManager->persist($accommodation);
        $entityManager->flush();

        return $this->render('AppBundle:Welcome:homepage.html.twig');
    }

    /**
     * @Route("/example/accommodation/{accommodationId}/dbal-query-builder")
     */
    public function accommodationDbalQueryBuilderAction($accommodationId)
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
        if (!$accommodation) {
            throw $this->createNotFoundException(
                sprintf('Accommodation with id "%s" not found.', $accommodationId));
        }

        return $this->render('AppBundle:Example:accommodationQueryBuilder.html.twig', [
            'accommodation' => $accommodation,
        ]);
    }

    /**
     * @Route("/example/forms/begin")
     */
    public function formsBeginAction(Request $request)
    {
        $user = new User();
        $user->firstname = 'Mate';
        $user->phones = ['4575467457','3454574567','347466567','4575467457','3454574567','347466567'];
        $form = $this->createForm(UserType::class, $user, ['validation_groups' => ['broj', 'tekst']]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
        }

        return $this->render('AppBundle:Example:formsBegin.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/example/validation")
     */
    public function validationAction(Request $request)
    {
        $user = new User();
        $user->firstname = '140';

        $validator = $this->get('validator');
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new Response('Nema greške');
    }

    /**
     * @Route("/example/user-in-controller")
     */
    public function userInControllerAction()
    {
        // Ako korisnik nije logiran, bacit ćemo Symfony AccessDeniedException koji će uhvatiti security sistem od
        // Symfony-ja i presumjeriti nas na stranicu za prijavu
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->getUser();

        return new Response('<html><body>Hello ' . $user->getName() . ' ' . $user->getSurname() . '</body></html>');
    }


    ######################## Primjeri Symfony Http Cache-a ########################
    #
    # Da bi ovo mogli testirati u development načinu rada, potrebno je u web\app_dev.php front controlleru odkomentirati
    # liniju:
    # // $kernel = new AppCache($kernel);
    #
    # U produkcijskom načinu rada je prije prvog pokretanja potrebno počistiti Symfony cache u konzoli:
    # php bin/console cache:clear --env=prod
    #

    /**
     * @Route("/example/cache/expiration/super-slow-page")
     */
    public function superSlowAction()
    {
        // Simulira neku kompliciranu i dugotrajnu kalkulaciju koja će se izvršiti kod prvog poziva, svaki request za ovu
        // akciju će kroz idućih sat vremena biti dohvaćan iz cache-a, što znači da se ovo neće izvršiti.
        sleep(1);
        $response = $this->render('AppBundle:Welcome:homepage.html.twig');

        // Postavljamo TTL (eng. time to live) ili vrijeme trajanja response-a u cache-u. Vrijeme je u sekundama. Nakon
        // isteka 3600 sekundi response se smatra zastarjelim (eng. stale) i cache će zatražiti svježu (eng. fresh)
        // verziju koja će opet biti cachirana na 1 sat.
        // Riječ *Shared* u nazivu metode znači da je cache public (javan), tj. da vrijedi za sve korisnike.
        $response->setSharedMaxAge(3600);

        // Opcionalno
        $response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }

    /**
     * @Route("/example/cache/validation/etag")
     */
    public function superSlowWithEtagCacheAction(Request $request)
    {
        $response = $this->render('AppBundle:Welcome:homepage.html.twig');

        // Postavljamo hash od cijelog sadržaja stranice kao ETag. Čim se sadržaj promijeni, promijeniti će se i hash i
        // vrijednost ETag-a
        $response->setETag(md5($response->getContent()));

        // setPublic() je bitno pozvati kako bi se isti response cachirao za *sve* korisnike
        $response->setPublic();

        // Kad pozovemo isNotModified($request) na Response objektu, Symfony uspoređuje ETag koji je dobio u Requestu
        // (postavlja ga reverse proxy u request header If-None-Match) sa ETag-om koji smo postavili u Response, i ako su
        // isti onda postavlja http kôd response-a na 304 (Not modified) i briše cijeli sadržaj Response objekta.
        $response->isNotModified($request);

        /**
         * Primjetimo da se kod validation cache-a akcija izvršava *svaki put*, za razliku od expiration cache-a gdje se
         * izvršava samo kada istekne rok trajanja response-a. U ovom slučaju nismo uštedjeli CPU resurse, nego samo
         * bandwidth (usporedite veličinu necachiranog response-a (ctrl+F5) i 304 response-a).
         */

        return $response;
    }

    /**
     * @Route("/example/cache/validation/last-modified/accommodation/{accommodationId}")
     */
    public function accommodationAction($accommodationId, Request $request)
    {
        $accommodationRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Accommodation');
        $accommodation = $accommodationRepository->findByIdWithPlace($accommodationId);

        if (!$accommodation) {
            throw $this->createNotFoundException(sprintf('Accommodation with id "%s" not found.', $accommodationId));
        }

        $response = new Response();
        // U ovom slučaju smo response cachirali po datumu zadnje promjene smještaja.
        $response->setLastModified($accommodation->getModified());
        $response->setPublic();

        // isNotModified($request) će u ovom slučaju usporediti datum zadnje promjene koji smo postavili u Response
        // objekt sa If-Modified-Since request headerom (kojeg postavlja Reverse proxy). Ako se poklapaju, Response nije
        // promijenjen i isNotModified() postavlja http kôd na 304, briše sadržaj response-a i vraća true.
        // Ako se ne poklapaju znači da je došlo do izmjene i isNotModified() vraća false, što znači da ćemo za za
        // response ponovo renderirati twig template.
        if ($response->isNotModified($request)) {
            return $response;
        }

        /**
         * Ovo je slično kao i ETag validacija iz gornjeg primjera, samo se u ovom slučaju osim bandwidtha uštedi i
         * CPU resurse jer se neće svaki put renderirati Twig template.
         */

        // Donji dio kôda se neće izvršiti ako se nije promijenio datum izmjene smještaja.
        $content = $this->renderView('AppBundle:Accommodation:accommodation.html.twig', [
            'accommodation' => $accommodation,
            'reservedDates' => [],
        ]);

        return $response->setContent($content);
    }

    /**
     * @Route("/example/translation-in-controller")
     */
    public function translationInController()
    {
        $translations = [];
        $translations[] = $this->get('translator')->trans('Symfony is great', [], 'messages', 'hr');
        $translations[] = $this->get('translator')->trans('Symfony is great', [], 'messages', 'en');
        $translations[] = $this->get('translator')->trans('Symfony is great', [], 'messages', 'en_US');
        $translations[] = $this->get('translator')->trans('Symfony is great', [], 'messages', 'en_GB');
        $translations[] = $this->get('translator')->trans('Symfony is great', [], 'messages', 'fr');

        return new Response(sprintf('<html><body>%s</body></html>', implode('<br />', $translations)));
    }

    /**
     * @Route("/example/translation-with-placeholders")
     */
    public function translationWithPlaceholders()
    {
        $translations = [];
        $translations[] = $this->get('translator')->trans('Hello %name%', ['%name%' => 'Fabien'], 'messages', 'hr');
        $translations[] = $this->get('translator')->trans('Hello %name%', ['%name%' => 'Fabien'], 'messages', 'en');
        $translations[] = $this->get('translator')->trans('Hello %name%', ['%name%' => 'Fabien'], 'messages', 'fr');
        $translations[] = $this->get('translator')->trans('Hello %name%', ['%name%' => 'Fabien'], 'messages', 'it');
        // Kako ne postoji prijevod za poruku Hello %name% na lokalu "fr_BE", Symfony će prijevod prvo potražiti za "fr"
        // lokal, a tek onda za fallback lokal
        $translations[] = $this->get('translator')->trans('Hello %name%', ['%name%' => 'Fabien'], null, 'fr_BE');

        return new Response(sprintf('<html><body>%s</body></html>', implode('<br />', $translations)));
    }
}
