<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bonobo;
use AppBundle\Form\BonoboType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $bonobos = $this->getDoctrine()->getRepository("AppBundle:Bonobo")->findAll();
        return $this->render("list.html.twig", array(
            'bonobos' => $bonobos,
        ));
    }
}
