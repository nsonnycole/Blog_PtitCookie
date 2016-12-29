<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\Article;
use BlogBundle\Form\Type\ArticleType;
use BlogBundle\Entity\Categorie;
use BlogBundle\Form\Type\CategorieType;
use BlogBundle\Entity\Tag;
use BlogBundle\Form\Type\TagType;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{

/**
* @Route("/administration/indexAdmin", name="indexAdmin")
*/
  public function indexAction(request $request)
  {
    $article = new Article();
      $categorie = new Categorie();
      $tag = new Tag();
    

      $formArticle = $this->createForm(ArticleType::class, $article);
      $formArticle->handleRequest($request);
      $formCategorie = $this->createForm(CategorieType::class, $categorie);
      $formCategorie->handleRequest($request);
      $formTag = $this->createForm(TagType::class, $tag);
      $formTag->handleRequest($request);
      if ($formArticle->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($article);
              $em->flush();
              $session->getFlashBag()->add('success', 'L\'article a été ajouté !');
      }
      if ($formCategorie->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($categorie);
              $em->flush();
              $session->getFlashBag()->add('success', 'La catégorie a été ajoutée !');
      }
      if ($formTag->isValid()) {
              $em = $this->getDoctrine()->getManager();
              $em->persist($tag);
              $em->flush();
              $session->getFlashBag()->add('success', 'Le tag a été ajoutée !');
      }
      return $this->render('administration/indexAdmin.html.twig', array(
              'formArticle' => $formArticle->createView(),
              'formTag' => $formTag->createView(),
              'formCategorie' => $formCategorie->createView()
      ));
  }
  /**
  * @Route("/administration/indexAdmin", name="indexAdmin")*/
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
  * @Route("/login", name="login")
  */
  public function loginAction( Request $request)
  {
    $authenticationUtils = $this->get('security.authentication_utils');
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();
    return $this->render('BlogBundle:Admin:login.html.twig',array(
      'last_username' => $lastUsername,
      'error'         => $error,
    ));
  }
  /**
  * @Route("/login_check", name="login_check")
  */
  public function loginCheckAction( Request $request)
  {
    return $this->redirectToRoute('admin', array(), 301);
  }
  /**
  * @Route("/logout", name="logout")
  */
  public function logoutAction( Request $request)
  {
  }


}
