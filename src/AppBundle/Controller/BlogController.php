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
        // replace this example code with whatever you need
        return $this->render('blog/blog.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/blog/afficheParCat", name="afficheParCat")
     */
    public function afficheParCatAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('blog/afficheParCat.html.twig');
    }

    /**
     * @Route("/blog/afficheArticle", name="afficheArticle")
     */
    public function afficheArticleAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('blog/afficheArticle.html.twig');
    }
}
