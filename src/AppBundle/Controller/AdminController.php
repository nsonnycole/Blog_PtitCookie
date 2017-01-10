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
      return $this->redirectToRoute('indexAdmin');
      return new Response("l'article à bien été ajouté!");
    }

    return $this->render('administration/ajoutArticle.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  *@Route("/edit/{id}", name="editArticle", requirements={"id" = "\d+"})
  */
  public function editArticleAction(Request $request, Article $id)
  {

    $form = $this->createForm(ArticleType::class,$id);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->flush();

      return $this->redirectToRoute('indexAdmin');
      return new Response("L'article à bien été modifié!");
    }
    return $this->render('administration/ajoutArticle.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/indexAdmin/{id}", name="delArticle", requirements={"id" = "\d+"})
  */
  public function delArticleAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();
    $article = $this->getDoctrine()->getRepository('AppBundle:Article')->getById($id);
    $em->remove($article);
    $em->flush();
    return $this->render('administration/indexAdmin.html.twig');
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

      return $this->redirectToRoute('indexAdmin');
      return new Response("Le tag à bien été ajouté!");
    }
    return $this->render('administration/ajoutTag.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  *@Route("/edit/{id}", name="editTag", requirements={"id" = "\d+"})
  */
  public function editTagAction(Request $request, Tag $id)
  {

    $form = $this->createForm(TagType::class,$id);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->flush();

      return $this->redirectToRoute('indexAdmin');
      return new Response("Le tag à bien été modifié!");
    }
    return $this->render('administration/ajoutTag.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/indexAdmin/{id}", name="delTag", requirements={"id" = "\d+"})
  */
  public function delTagAction(Request $request,$id)
  {
    $em = $this->getDoctrine()->getManager();
    $tag = $em->getRepository('AppBundle:Tag')->getTagById($id);
    $em->remove($tag);
    $em->flush();
    return $this->render('administration/indexAdmin.html.twig');
  }

  /**
  * @Route("/administration/ajoutCategorie", name="ajoutCategorie")
  */
  public function ajoutCategorieAction(Request $request)
  {

    $categorie = new Categorie();
    $form = $this->createForm(CategorieType::class);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($categorie);
      $em->flush();
      return $this->redirectToRoute('indexAdmin');
      return new Response("La catégorie à bien été ajouté!");
    }
    return $this->render('administration/ajoutCategorie.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  *@Route("/edit/{id}", name="editCategorie", requirements={"id" = "\d+"})
  */
  public function editCategorieAction(Request $request, Categorie $id)
  {

    $form = $this->createForm(CategorieType::class, $id);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->flush();

      return $this->redirectToRoute('indexAdmin');
      return new Response("La catégorie à bien été modifié!");
    }
    return $this->render('administration/ajoutCategorie.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/indexAdmin/{id}", name="delCategorie", requirements={"id" = "\d+"})
  */
  public function delCategorieAction(Request $request, $id)
  {

    $em = $this->getDoctrine()->getManager();
    $categorie = $this->getDoctrine()->getRepository('AppBundle:Categorie')->getById($id);
    $em->remove($categorie);
    $em->flush();
    return $this->render('administration/indexAdmin.html.twig');

  }


}
