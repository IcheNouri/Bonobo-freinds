<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bonobo;
use AppBundle\Form\BonoboType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class BonoboController extends Controller
{
    /**
     * @param Request $request
     * @Route("/add-bonobo", name="add_bonobo")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addBonoboAction(Request $request) {
        $bonobo = new Bonobo();
        $form = $this->createForm(BonoboType::class, $bonobo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $user->addBonobo($bonobo);
            $em = $this->getDoctrine()->getManager();
            $em->merge($user);
            $em->flush();
        }

        return $this->render("form.html.twig", array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @Route("/bonobo/{id}", name="one_bonobo")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBonoboAction(Request $request) {
        $bonobo =  $this->getDoctrine()
                        ->getRepository("AppBundle:Bonobo")
                        ->findOneById($request->get("id"));
        if (!empty($bonobo)) {
            return $this->render("bonobo-info.html.twig", array(
                'bonobo' => $bonobo,
            ));
        }
        else {
            return $this->render("bonobo-info.html.twig", array(
                'success' => false,
            ));
        }
    }

    /**
     * @param Request $request
     * @Route("/bonobo-edit/{id}", name="edit bonobo")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editBonoboAction(Request $request) {
        $bonobo =  $this->getDoctrine()
            ->getRepository("AppBundle:Bonobo")
            ->findOneById($request->get("id"));

        if (empty($bonobo)) {
            return $this->render("bonobo-info.html.twig", array(
                'success' => false,
            ));
        }

        $form = $this->createForm(BonoboType::class, $bonobo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->merge($bonobo);
            $em->flush();
        }

        return $this->render("form.html.twig", array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @Route("/bonobo-delete/{id}", name="delete bonobo")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteBonboAction(Request $request) {
        $bonobo =  $this->getDoctrine()
            ->getRepository("AppBundle:Bonobo")
            ->findOneById($request->get("id"));

        if (empty($bonobo)) {
            return $this->render("bonobo-info.html.twig", array(
                'success' => false,
            ));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($bonobo);
        $em->flush();

        return $this->render("bonobo-info.html.twig", array(
            'success' => true,
        ));
    }
}