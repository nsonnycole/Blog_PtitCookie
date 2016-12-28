<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
  /**
  * @Route("/blog/blog", name="blog")
  */
  public function blogAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $articles = $em->getRepository('AppBundle:Article')->getAllArtcicles();
    return $this->render('blog/blog.html.twig', array(
      'articles' => $articles
    ));

  }
  /**
  * @Route("/blog/categorie/{id}", name="afficheParCat", requirements={"id" = "\d+"})
  */
  public function afficheParCatAction(Request $request,$id)
  {
    $categorie = $this->getDoctrine()->getRepository('AppBundle:Categorie')->getById($id);
    $articleCategorie = $this->getDoctrine()->getRepository('AppBundle:Article')->findBy(array('categorie' => $categorie));
    return $this->render('blog/afficheParCat.html.twig', array(
      'articles' => $articleCategorie,
    ));
  }


  /**
  * @Route("/blog/afficheArticle/{id}", name="afficheArticle", requirements={"id" = "\d+"})
  */
  public function afficheArticleAction(Request $request,$id)
  {
    $em = $this->getDoctrine()->getManager();
    $article = $em->getRepository('AppBundle:Article')->getById($id);

    return $this->render('blog/afficheArticle.html.twig', array(
      'Article' => $article,

    ));
  }

  /**
  * @Route("/blog/afficheParCat/{id}", name="afficheParCatArticle, requirements={"id" = "\d+"}")
  */
  /*public function afficheParCatArticleAction(Request $request,$id)
  {
    $categorie = $this->getDoctrine()->getRepository('AppBundle:Categorie')->getArticles($id);
    return $this->render('blog/afficheParCatArticle.html.twig',array(
      'categorie' => $categorie,
    ));
  }*/

}
