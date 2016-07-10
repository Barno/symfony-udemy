<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class DefaultController extends Controller {


  /**
   * @Route("/json", name="json")
   * @Method({"GET"})
   */
  public function jsonAction(Request $request) {
    $data = json_encode(['username' => 'alessio']);
    $response = new Response($data);
    $response->headers->set('content-type','application/json');
    return $response;
  }

  /**
   * @Route("/file", name="file")
   * @Method({"GET"})
   */
  public function fileAction(Request $request) {

    $file = $this->get('kernel')->getRootDir().'/../web/uploads/Symfony_cookbook_3.0.pdf';
    $response = new BinaryFileResponse($file);

    $dispostion = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'guidaSymfony.pdf');

    $response->deleteFileAfterSend(true);
    $response->headers->set('Content-Disposition', $dispostion);
    return $response;
  }

  /**
   * @Route("/redirect", name="redirect")
   * @Method({"GET"})
   */
  public function redirectAction(Request $request) {

    $response = new RedirectResponse('http://www.udemy.com');
    return $response;
  }

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
