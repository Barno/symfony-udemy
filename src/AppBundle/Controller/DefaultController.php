<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $this->get('security.password_encoder')->encodePassword($user,$user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/register.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/riservato", name="riservato")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function risevatoAction(Request $request)
    {
       $response = new Response("riservato");
        //var_dump($this->getUser());
        return $response;
    }






    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATORE', null, 'Accesso negato');
        $response = new Response('ADMIN');
        return $response;
    }
}
