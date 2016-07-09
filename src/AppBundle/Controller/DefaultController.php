<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/{nome}", name="homepage")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request,$nome)
    {
        throw $this->createNotFoundException('The product does not exist');
        exit;
        echo $request->attributes->get('nome');
        $request->request->add(array('param' => 'POST'));
        return $this->render('default/index.html.twig',['res' => $request]);
    }
}
