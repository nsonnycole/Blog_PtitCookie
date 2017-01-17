<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\Type\RechercheType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $articles = $em->getRepository('AppBundle:Article')->getAllArtcicles();
      $form = $this->createForm(RechercheType::class);


      if($request->getMethod() == 'POST')
      {
      $form->bindRequest($request);
        if($form->isSubmitted())
        {
          $em = $this->getDoctrine()->getManager();
        //On récupère les données entrées dans le formulaire par l'utilisateur
          $data = $form->getData();
          //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire
          $resultatRecherche = $em->getRepository('AppBundle:Article')
                                  ->rechercheArticleByParametres($data);
          //Puis on redirige vers la page de visualisation de cette liste d'annonces

          return $this->render('default/recherche.html.twig', array(
            'resultatRecherche' => $resultatRecherche)
          );
        }
      }

        return $this->render('default/index.html.twig', array(
                'articles' => $articles,
                'form' =>$form->createView()
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
