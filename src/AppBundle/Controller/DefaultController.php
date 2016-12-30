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

      $em = $this->getDoctrine()->getManager();
      $articles = $em->getRepository('AppBundle:Article')->getAllArtcicles();
      return $this->render('default/index.html.twig', array(
              'articles' => $articles
      ));

    }
    /**
     * @Route("/faq", name="faq")
     */
    public function faqAction(Request $request)
    {
      return $this->render('default/faq.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
      return $this->render('default/contact.html.twig');
    }


}
