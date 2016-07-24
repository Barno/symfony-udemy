<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
  /**
   * @Route("/{_locale}/", name="homepage")
   */
  public function indexAction(Request $request) {
    $date = new \DateTime("now");
    $date = $date->format('d-m-Y H:i:s');

    $users = ['cognone' => 'Barnini', 'nome' => 'Alessio', 'citta' => 'Livorno'];
    $nome = 'Barno';

    $welcome = "<h2>Welcome</h2>";

    return $this->render('default/index.html.twig', array(
            'date' => $date,
            'users' => $users,
            'nome' => $nome,
            'welcome' => $welcome,
            'javascript' => "<script>alert('hello Mr Robot')</script>",
            'pippo' => "PIPPO",
    ));
  }
}
