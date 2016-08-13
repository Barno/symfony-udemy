<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

  /**
   * @Route("/{_locale}/", name="homepage",requirements={"_locale": "en|it"})
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

  /**
   * @Route("/tag", name="tag")
   */
  public function funzioniAction(Request $request) {

    return $this->render('default/funzioni.html.twig', array());
  }

  /**
   * @Route("/for", name="for")
   */
  public function forAction(Request $request) {

    $users[] = ['nome' => 'alessio', 'cognome' => 'barnini', 'interessi' => ['calcio', 'skate', 'yoga'], 'anni' => 33];
    $users[] = ['nome' => 'marco', 'cognome' => 'rossi', 'interessi' => ['basket', 'surf'], 'anni' => '33'];
    $users[] = ['nome' => 'arianna', 'cognome' => 'verdi', 'interessi' => 'cucina', 'anni' => 36];


    return $this->render('default/for.html.twig', array(
            'users' => $users
    ));
  }

  /**
   * @Route("/extends", name="extends")
   */
  public function extendsAction(Request $request) {
    return $this->render('extends/extends.html.twig', array()
    );
  }

  /**
   * @Route("/primo", name="primo")
   */
  public function primoAction(Request $request) {
    return $this->render('extends/primo.html.twig', array()
    );
  }

  /**
   * @Route("/render", name="render")
   */
  public function renderAction(Request $request) {
    return $this->render('render/render.html.twig', array()
    );
  }

  /**
   * @Route("/news", name="news")
   */
  public function newsAction(Request $request, $max = 1) {

    $news[] = ['testo' => 'notizia numero 1'];
    $news[] = ['testo' => 'notizia numero 2'];
    $news[] = ['testo' => 'notizia numero 3'];
    $news[] = ['testo' => 'notizia numero 4'];
    $news[] = ['testo' => 'notizia numero 5'];
    $news[] = ['testo' => 'notizia numero 6'];
    $news[] = ['testo' => 'notizia numero 7'];
    $news[] = ['testo' => 'notizia numero 8'];
    $news[] = ['testo' => 'notizia numero 9'];
    $news[] = ['testo' => 'notizia numero 10'];

    return $this->render('render/news.html.twig', array(
                    'news' => $news,
                    'max' => $max

            )
    );
  }

  /**
   * @Route("/riservato/{foo}", name="riservato",defaults={"foo":1})
   */
  public function securityAction(Request $request) {
    return $this->render('riservato/riservato.html.twig', array()
    );
  }

}
