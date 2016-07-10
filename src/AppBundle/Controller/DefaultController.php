<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utente;
use AppBundle\Form\UtenteType;
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
        $utente = new Utente();
        $form = $this->createForm(UtenteType::class,$utente);

        return $this->render('default/index.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
