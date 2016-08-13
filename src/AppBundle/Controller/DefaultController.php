<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/{nome}/{ruolo}",name="homepage_stringa",schemes={"http","https"},host="m.example.com")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request,$nome,$ruolo)
    {

        //echo $request->attributes->get('_route_params')['nome'];
        //echo "<br>";
        //echo $request->attributes->get('ruolo');

        echo $request->attributes->get('_controller');
        return $this->render('default/index.html.twig',array());
    }

}
