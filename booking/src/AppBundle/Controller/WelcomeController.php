<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WelcomeController extends Controller
{
    /**
     * @Route("/", name="AppBundle_Welcome_homepage")
     */
    public function homepageAction(Request $request)
    {
        return $this->render('AppBundle:Welcome:homepage.html.twig');
    }

    /**
     * @Route("/about", name="AppBundle_Welcome_about")
     */
    public function aboutAction()
    {
        return $this->render('AppBundle:Welcome:about.html.twig');
    }
}
