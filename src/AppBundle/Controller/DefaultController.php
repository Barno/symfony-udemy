<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig',array());
    }


    /**
     * @Route("{_locale}/users/new", name="users_new", requirements={"_locale" = "en|it"})
     * @Method({"GET","POST"})
     */
    public function createUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){

            $em = $this->getDoctrine()->getManager();
            $fileName = $this->get('app.avatar_upload')->upload($user->getAvatar());
            $user->setAvatar($fileName);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/users.html.twig',
          array('form' => $form->createView())
        );
    }

    /**
     * @Route("{_locale}/users/{id}/edit", name="users_edit",requirements={"_locale" = "en|it"}))
     * @Method({"GET","PUT"})
     */
    public function editAction(Request $request, User $user){

        $user->setAvatar(new File($this->getParameter('upload_dir').'/'.$user->getAvatar()));

        $form = $this->createForm(UserType::class,$user,
                array('method' => 'PUT')
        );

        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){
            //UPDATE Utente
            $em = $this->getDoctrine()->getManager();
            $fileName = $this->get('app.avatar_upload')->upload($user->getAvatar());
            $user->setAvatar($fileName);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/users.html.twig',
                array('form' => $form->createView())
        );
    }


}
