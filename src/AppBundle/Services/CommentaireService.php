<?php
namespace AppBundle\Services;
use Doctrine\ORM\EntityManager;

class CommentaireService
{
    /**
     * @var EntityManager
     */
    private $doctrine;
    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }
    /**
     * Retourne le nombre total de commentaires sur un article
     * @param  int $id Identifiant de l'article
     * @return int
     */
    public function getTotalCommentaire($id)
    {
        return $this
            ->doctrine
            ->getRepository('AppBundle:Commentaire')
            ->getListComments($id)
        ;
    }

}
