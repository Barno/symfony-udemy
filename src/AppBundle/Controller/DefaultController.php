<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request,$nome,$ruolo,$_format)
    {

        //var_dump($request->attributes->get('_route_params'));
        //echo "<br>";
        //echo $request->attributes->get('ruolo');
        //echo "<br>";
        //
        //echo $request->attributes->get('_controller');
        return $this->render('default/index.'.$_format.'.twig',array());
    }

}
