<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utente;
use AppBundle\Form\UtenteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $form->handleRequest($request);

        if($form->isSubmitted() && $request->isXmlHttpRequest()){

            $response = new JsonResponse();

            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($utente);
                $em->flush();
                $out['status'] = 'OK';
                $out['msg'] = 'SUCCESS!';
                $response->setData($out);
                return $response;
            }else{
                $errors = $form->getErrors(true,true);

                $msg['status'] = 'KO';
                foreach ($errors as $error) {
                    $err[] = $error->getMessage(). '<br/>';
                }
                $response->setData(array('status' => 'KO','errors' => $err));

                return $response;
            }
        }



        return $this->render('default/index.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
