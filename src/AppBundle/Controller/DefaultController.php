<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utente;
use AppBundle\Form\UtenteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $utente = new Utente();
        $form = $this->createForm(UtenteType::class,$utente);

        $form->handleRequest($request);

        if($form->isSubmitted() && $request->isXmlHttpRequest()){

            $response = new JsonResponse();

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($utente);
                $em->flush();
                $out['status'] = 'OK';
                $out['template'] = $this->renderView(':default:success.html.twig',array('utente' => $utente));
                $response->setData($out);
                return $response;
            }else{
                $errors = $form->getErrors(true,true);
                $msg['status'] = 'KO';
                foreach ($errors as $error) {
                    $err[] = $error->getMessage();
                }
                $response->setData(array('status' => 'KO','template' => $this->renderView(':default:errors.html.twig',array('errors' => $err))));
                return $response;
            }
        }



        return $this->render('default/index.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
