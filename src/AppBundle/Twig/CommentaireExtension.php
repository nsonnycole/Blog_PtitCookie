<?php
namespace AppBundle\Twig;
use AppBundle\Services\CommentaireService;

class CommentaireExtension extends \Twig_Extension
{
    /**
     * @var CommentaireService
     */
    private $CommentaireService;
    /**
     * @param CommentaireService $CommentaireService
     */
    public function __construct(CommentaireService $CommentaireService)
    {
        $this->CommentaireService = $CommentaireService;
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'get_total_commentaire',
                [$this, 'getTotalCommentaire']
            )
        ];
    }
    public function getTotalCommentaire($id)
    {
        return $this->CommentaireService->getTotalCommentaire($id);
    }

}
