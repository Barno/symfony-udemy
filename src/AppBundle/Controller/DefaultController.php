<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request,$nome,$ruolo)
    {

        //echo $request->attributes->get('_route_params')['nome'];
        //echo "<br>";
        //echo $request->attributes->get('ruolo');

        echo $request->attributes->get('_controller');
        return $this->render('default/index.html.twig',array());
    }

    public function index2Action(Request $request,$nome)
    {
        echo $request->attributes->get('_controller');
        return $this->render('default/index.html.twig',array());
    }
}
