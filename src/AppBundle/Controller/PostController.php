<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class PostController extends Controller
{
    /**
     * @Route("/posts",name="posts")
     */
    public function postAction(Request $request)
    {
        $user = $this->getUser();

        if(!is_object($user) || !$user instanceof UserInterface){
            throw new AccessDeniedException("No User ?");
        }

        $post = new Post();
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $post->setUsers($this->getUser());
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render(':post:post.html.twig',array('form' => $form->createView()));


    }
}
