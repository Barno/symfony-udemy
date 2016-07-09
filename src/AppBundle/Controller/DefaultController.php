<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/{nome}/{cognome}", name="homepage")
     */
    public function indexAction(Request $request,$nome)
    {
        echo $nome;
        echo "<br/>";
        echo $request->get('nome');
        echo "<br/>";
        echo $request->attributes->get('nome');
        echo "<br/>";
        echo $request->attributes->get('_route_params')['nome'];


        return $this->render('default/index.html.twig');
    }
}
