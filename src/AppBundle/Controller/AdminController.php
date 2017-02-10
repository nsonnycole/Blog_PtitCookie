<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
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

    $session = new Session();
    $article = new Article();
    $form = $this->createForm(ArticleType::class, $article);
    $form->handleRequest($request);
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $article->setMembre($user);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($article);
      $em->flush();
      $session->getFlashBag()->add('success', 'l\'article à bien été ajouté!');
      return $this->redirectToRoute('indexAdmin', array(), 301);
    }

    return $this->render('administration/ajoutArticle.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  *@Route("/administration/modifArticle/{id}", name="editArticle", requirements={"id" = "\d+"})
  */
  public function editArticleAction(Request $request, Article $id)
  {
    $session = new Session();
    $form = $this->createForm(ArticleType::class,$id);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->flush();

        $session->getFlashBag()->add('success', 'l\'article à bien été modifié !');
      return $this->redirectToRoute('indexAdmin', array(), 301);
    }
    return $this->render('administration/modifArticle.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/indexAdmin/{id}", name="delArticle", requirements={"id" = "\d+"})
  */
  public function delArticleAction(Request $request, $id)
  {
    $session = new Session();
    $em = $this->getDoctrine()->getManager();
    $article = $this->getDoctrine()->getRepository('AppBundle:Article')->getById($id);
    $em->remove($article);
    $em->flush();
    $session->getFlashBag()->add('success', 'l\'article à bien été supprimé !');
      return $this->redirectToRoute('indexAdmin', array(), 301);
  }


  /**
  * @Route("/administration/ajoutTag", name="ajoutTag")
  */
  public function ajoutTagAction(Request $request)
  {
    $session = new Session();
    $tag = new Tag();
    $form = $this->createForm(TagType::class, $tag);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($tag);
      $em->flush();
      $session->getFlashBag()->add('success', 'le tag à bien été ajouté!');
      return $this->redirectToRoute('indexAdmin', array(), 301);

    }
    return $this->render('administration/ajoutTag.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  *@Route("/administration/modifTag/{id}", name="editTag", requirements={"id" = "\d+"})
  */
  public function editTagAction(Request $request, Tag $id)
  {
    $session = new Session();
    $form = $this->createForm(TagType::class,$id);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->flush();
      $session->getFlashBag()->add('success', 'le tag à bien été modifié !');
      return $this->redirectToRoute('indexAdmin', array(), 301);
    }
    return $this->render('administration/modifTag.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/indexAdmin/{id}", name="delTag", requirements={"id" = "\d+"})
  */
  public function delTagAction(Request $request,$id)
  {
    $session = new Session();
    $em = $this->getDoctrine()->getManager();
    $tag = $em->getRepository('AppBundle:Tag')->getTagById($id);
    $em->remove($tag);
    $session->getFlashBag()->add('success', 'le tag à bien été supprimé !');
    return $this->redirectToRoute('indexAdmin', array(), 301);
  }

  /**
  * @Route("/administration/ajoutCategorie", name="ajoutCategorie")
  */
  public function ajoutCategorieAction(Request $request)
  {

    $session = new Session();
    $categorie = new Categorie();
    $form = $this->createForm(CategorieType::class, $categorie);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($categorie);
      $em->flush();
        $session->getFlashBag()->add('success', 'la catégorie à bien été ajouté!');
        return $this->redirectToRoute('indexAdmin', array(), 301);
    }
    return $this->render('administration/ajoutCategorie.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  *@Route("/administration/modifCategorie/{id}", name="editCategorie", requirements={"id" = "\d+"})
  */
  public function editCategorieAction(Request $request, Categorie $id)
  {

    $session = new Session();
    $form = $this->createForm(CategorieType::class, $id);
    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->flush();
      $session->getFlashBag()->add('success', 'la catégorie à bien été modifié!');
      return $this->redirectToRoute('indexAdmin', array(), 301);

    }
    return $this->render('administration/modifCategorie.html.twig',[
            'form' => $form->createView()
        ]);
  }

  /**
  * @Route("/administration/indexAdmin/{id}", name="delCategorie", requirements={"id" = "\d+"})
  */
  public function delCategorieAction(Request $request, $id)
  {
     $session = new Session();
    $em = $this->getDoctrine()->getManager();
    $categorie = $this->getDoctrine()->getRepository('AppBundle:Categorie')->getCatById($id);
    $em->remove($categorie);
    $em->flush();
      $session->getFlashBag()->add('success', 'la catégorie à bien été supprimé!');
      return $this->redirectToRoute('indexAdmin', array(), 301);

  }

  /**
  * @Route("/administration/indexAdmin/{id}", name="delComment", requirements={"id" = "\d+"})
  */
  public function delCommentAction(Request $request, $id)
  {
    $session = new Session();
    $em = $this->getDoctrine()->getManager();
    $commentaire = $this->getDoctrine()->getRepository('AppBundle:Commentaire')->getComment($id);
    $em->remove($commentaire);
    $session->getFlashBag()->add('success', 'le commentaire à bien été supprimé!');
    return $this->redirectToRoute('indexAdmin', array(), 301);

  }

  /**
     * @Route("/administration/login", name="menu_login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('administration/login.html.twig',array(
                'last_username' => $lastUsername,
                'error'         => $error,
        ));
    }
    /**
     * @Route("/login_check", name="menu_check")
     */
    public function loginCheckAction(Request $request)
    {
        return $this->redirectToRoute('homepage', array(), 301);
    }

    /**
  * @Route("/logout", name="logout")
  */
  public function logoutAction( Request $request)
  {
        return $this->redirectToRoute('homepage', array(), 301);
  }



}
