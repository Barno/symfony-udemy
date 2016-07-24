<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
  /**
   * @Route("/", name="homepage")
   */
  public function indexAction(Request $request) {
    $date = new \DateTime("now");
    $date = $date->format('d-m-Y H:i:s');

    $users = ['cognone' => 'Barnini', 'nome' => 'Alessio', 'citta' => 'Livorno'];

    return $this->render('default/index.html.twig', array(
            'date' => $date,
            'users' => $users
    ));
  }
}
