<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array());
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Non sei un amministratore');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Accesso negato');
        //$response = new Response('Admin');
        //var_dump($this->getUser());
        //var_dump($this->get('security.token_storage')->getToken()->getUser());
        //return $response;
        return $this->render('default/index.html.twig', array());
    }
}
