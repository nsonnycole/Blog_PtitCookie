<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Article
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 */
class Commentaire
{
	/**
    * @var int
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    public $id;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="commentaire", type="text")
    */
    public $commentaire;
    /**
     * @var string
		 *
     * @ORM\Column(name="auteur", type="text")
     */
    public $auteur;
    /**
     * @var \DateTime
     *
     * @Assert\Date()
     * @ORM\Column(name="date", type="datetime")
     */
    public $date;
    /**
    * @ORM\ManyToOne(targetEntity="Article")
    * @ORM\JoinColumn(name="article_id", referencedColumnName="id",onDelete="CASCADE")
    */
    public $article;


    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
        return $this;
    }
    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Commentaire
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }
    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commentaire
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set commentaire
     *
     * @param \AppBundle\Entity\Article $categorie
     *
     * @return Commentaire
     */
    public function setCommentArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;
        return $this;
    }
    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getCommentArticle()
    {
        return $this->article;
    }
}
