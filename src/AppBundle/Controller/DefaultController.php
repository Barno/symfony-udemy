<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

  /**
   * @Route("/{_locale}/{nome}/{ruolo}.{_format}",name="homepage_stringa",defaults={"ruolo":"ADMIN","_format": "html","title":"CIAO MONDO"},requirements={"nome":"[a-z]{0,}","_format":"html|xml","_locale":"%app.locales%"})
   * @Method({"GET","POST"})
   */
  public function indexAction(Request $request, $nome, $ruolo, $_format) {

    var_dump($request->attributes->get('_route_params'));

    echo $request->get('title');
    echo $request->attributes->get('_route_params')['title'];

    echo "<br>";
    echo $request->attributes->get('ruolo');
    echo "<br>";
    //
    //echo $request->attributes->get('_controller');
    return $this->render('default/index.' . $_format . '.twig', array());
  }

}
