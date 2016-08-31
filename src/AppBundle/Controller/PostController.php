<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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

    /**
     * @Route("/wall",name="wall")
     */
    public function wallAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('AppBundle:Post')->findAll();
        return $this->render(':post:wall.html.twig',array('posts' => $posts));
    }

    /**
     * //http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
     * @Route("/posts/{id}",name="single_post")
     * @ParamConverter("posts",class="AppBundle:Post")
     */
    public function getPostAction(Request $request,Post $post)
    {
        return $this->render(':post:singlepost.html.twig',array('post' => $post));
    }

    /**
     * //http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
     * @Route("/delete_post/{id}",name="delete_post")
     * @ParamConverter("posts",class="AppBundle:Post")
     * @Security("is_granted('delete',post)")
     */
    public function deletePostAction(Request $request,Post $post)
    {

        //if($this->denyAccessUnlessGranted('delete',$post)){
        //    throw new AccessDeniedHttpException('Questo non è un tuo post');
        //}

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('wall');
    }
}
