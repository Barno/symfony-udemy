<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

  /**
   * @Route("/", name="homepage")
   * @Method({"GET"})
   */
  public function indexAction(Request $request) {
    $cookie = new Cookie('nomeCookie','ValoreCookie',(time()+ 3600*27*7));
    $response = new Response();
    $response->headers->setCookie($cookie);
    $response->setContent($this->renderView(':default:index.html.twig'));
    return $response;
  }

  /**
   * @Route("/getCookie", name="getCookie")
   * @Method({"GET"})
   */
  public function getCookieAction(Request $request) {
    $cookie = $request->cookies->get('nomeCookie');

    if($request->cookies->has('nomeCookie')){
      echo $cookie;
    }
    //var_dump($request->cookies->keys());
    $response = new Response();
    $response->setContent($this->renderView(':default:index.html.twig'));
    return $response;
  }


  /**
   * @Route("/deleteCookie", name="deleteCookie")
   * @Method({"GET"})
   */
  public function deleteCookieAction(Request $request) {
    $response = new Response();
    $response->headers->clearCookie('nomeCookie');
    $response->setContent($this->renderView(':default:index.html.twig'));
    return $response;
  }



}
