<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $foo['nome'] = 'Alessio';
        $foo['nickname'] = 'Barno';
        $foo['data-di-nascita'] = '1983';
        $foo['prima'] = 0;
        $foo['prima-pagina'] = 1;
        return $this->render('default/index.html.twig',array('foo' => $foo,'pagina' => 15));
    }
}
