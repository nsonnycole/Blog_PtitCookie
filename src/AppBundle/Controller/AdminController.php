<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;
use AppBundle\Entity\Categorie;
use AppBundle\Form\Type\CategorieType;
use AppBundle\Entity\Tag;
use AppBundle\Form\Type\TagType;


class AdminController extends Controller
{

/**
* @Route("/administration/indexAdmin", name="indexAdmin")
*/
  public function adminAction(request $request)
  {
      $em = $this->getDoctrine()->getManager();
      $articles = $em->getRepository('AppBundle:Article')->getAllArtcicles();
      return $this->render('administration/indexAdmin.html.twig', array(
        'articles' => $articles
      ));

  }

/*
  public function adminAction(Request $request)
  {
    // replace this example code with whatever you need
    return $this->render('administration/indexAdmin.html.twig', [
      'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
    ]);
  }
  */

  /**
  * @Route("/administration/ajoutArticle", name="ajoutArticle")
  */
  public function ajoutArticleAction(Request $request)
  {
    
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);
    $form->handleRequest($request);

    return $this->render('administration/ajoutArticle.html.twig',[
            'form' => $form->createView()
        ]);
  }

}
