<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/admin")
 */
class DefaultController extends Controller {

  /**
   * @Route("/{_locale}/{nome}/{ruolo}.{_format}",name="homepage_stringa",defaults={"ruolo":"ADMIN","_format": "html","title":"CIAO MONDO"},requirements={"nome":"[a-z]{0,}","_format":"html|xml","_locale":"%app.locales%"})
   * @Method({"GET","POST"})
   */
  public function indexAction(Request $request, $nome, $ruolo, $_format) {

    //var_dump($request->attributes->get('_route_params'));
    //
    //echo $request->get('title');
    //echo $request->attributes->get('_route_params')['title'];
    //
    //echo "<br>";
    //echo $request->attributes->get('ruolo');
    //echo "<br>";
    echo $this->get('router')->generate('name_test');
    echo "<br>";
    echo $this->generateUrl('name_test',array(),UrlGeneratorInterface::ABSOLUTE_URL);
    echo "<br>";

    echo $this->generateUrl('name_test',array('page' => 2,'category' => 'news'));
    return $this->redirectToRoute('name_test',array('page' => 2,'category' => 'news'));

    echo "<br>";
    //
    //echo $request->attributes->get('_controller');
    return $this->render('default/index.' . $_format . '.twig', array());
  }

  /**
   * @Route("/test",name="name_test")
   * @Method({"GET","POST"})
   */
  public function testAction(Request $request) {

    var_dump($request->query->all());
    return $this->render('default/index.html.twig', array());
  }

}
