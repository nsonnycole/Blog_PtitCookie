<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Form\Type\ArticleType;
use AppBundle\Entity\Commentaire;
use AppBundle\Form\Type\CommentaireType;

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

  public function afficheArticleAction(request $request, $id)
{
    $article = $this->getDoctrine()->getRepository('AppBundle:Article')->getById($id);
    $Comment = new Commentaire();
    $Comments = $this->getDoctrine()->getRepository('AppBundle:Commentaire')->getListComments($id);
    $formComment = $this->createForm(CommentaireType::class, $Comment);
    $formComment->handleRequest($request);
    if ($formComment->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $Comment->setArticle($article);
            $em->persist($Comment);
            $em->flush();
     }
    return $this->render('blog/afficheArticle.html.twig', array(
            'formComment' => $formComment->createView(),
            'Article' => $article,
            'Comments' => $Comments
    ));
  }

  /**
  * @Route("/blog/ajoutArticle", name="ajoutArticle")
  */
  public function ajoutArticleAction(Request $request)
  {
    return $this->render('blog/ajoutArticle.html.twig');
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
