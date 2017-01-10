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
      $categories = $em->getRepository('AppBundle:Categorie')->getAllCategories();
      $tags = $em->getRepository('AppBundle:Tag')->getAllTags();

      return $this->render('administration/indexAdmin.html.twig', array(
        'articles' => $articles,
        'categories' => $categories,
        'tags' => $tags
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

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($article);
      $em->flush();
      return $this->render('administration/indexAdmin.html.twig');
      return new Response("l'article à bien été ajouté!");
    }

    return $this->render('administration/ajoutArticle.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/ajoutTag", name="ajoutTag")
  */
  public function ajoutTagAction(Request $request)
  {

    $tag = new Tag();
    $form = $this->createForm(TagType::class, $tag);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($tag);
      $em->flush();

      return $this->render('administration/indexAdmin.html.twig');
      return new Response("Le tag à bien été ajouté!");
    }
    return $this->render('administration/ajoutTag.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/ajoutCategorie", name="ajoutCategorie")
  */
  public function ajoutCategorieAction(Request $request)
  {

    $categorie = new Categorie();
    $form = $this->createForm(CategorieType::class, $categorie);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($categorie);
      $em->flush();
      return $this->render('administration/indexAdmin.html.twig');
      return new Response("La catégorie à bien été ajouté!");
    }
    return $this->render('administration/ajoutCategorie.html.twig',[
            'form' => $form->createView()
        ]);
  }


}
