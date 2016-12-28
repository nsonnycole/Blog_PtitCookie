<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
* Article
*
* @ORM\Table(name="article")
* @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
*/
class Article
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
	* @ORM\Column(name="description", type="text")
	*/
	public $description;
	/**
	* @var string
	*
	* @Assert\NotBlank()
	* @Assert\Length(
	*      min = 5,
	*      max = 30,
	*      minMessage = "Le titre doit comporter {{ limit }} caractères minimum ",
	*      maxMessage = "Le titre doit comporter {{ limit }} caractères maximum"
	* )
	* @ORM\Column(name="titre", type="text")
	*/
	public $titre;

	/**
	* @var string
	*
	* @Assert\NotBlank()
	* @ORM\Column(name="contenu", type="text")
	*/
	public $contenu;

	/**
	* @var \DateTime
	*
	* @Assert\Date()
	* @ORM\Column(name="datePost", type="datetime")
	*/
	public $datePost;
	/**
	*
	* @ORM\ManyToOne(targetEntity="Membre")
	* @ORM\JoinColumn(name="membre_id", referencedColumnName="id")
	*/
	public $membre;
	/**
	* @ORM\ManyToOne(targetEntity="Categorie")
	* @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
	*/
	public $categorie;
	/**
	* @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tag", cascade={"persist"})
	*/
	public $tags;

	/**
	* @var string
	*
	* @Assert\NotBlank()
	* @ORM\Column(name="image", type="text")
	*/
	public $image;

	/**
	* @var string
	*
	* @Assert\NotBlank()
	* @ORM\Column(name="difficulte", type="text")
	*/
	public $difficulte;


	public function __construct()
	{
		$this->date = new \DateTime();
		$this->tags = new ArrayCollection();
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
	* Set description
	*
	* @param string $description
	*
	* @return Article
	*/
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}
	/**
	* Get description
	*
	* @return string
	*/
	public function getDescription()
	{
		return $this->description;
	}
	/**
	* Set titre
	*
	* @param string $titre
	*
	* @return Article
	*/
	public function setTitre($titre)
	{
		$this->titre = $titre;
		return $this;
	}
	/**
	* Get titre
	*
	* @return string
	*/
	public function getTitre()
	{
		return $this->titre;
	}
	/**
	* Set date
	*
	* @param \DateTime $datePost
	*
	* @return Article
	*/
	public function setDate($datePost)
	{
		$this->date = $datePost;
		return $this;
	}
	/**
	* Get date
	*
	* @return \DateTime
	*/
	public function getDate()
	{
		return $this->datePost;
	}
	/**
	* Set membre
	*
	* @param \AppBundle\Entity\Membre $membre
	*
	* @return Article
	*/
	public function setMembre(\AppBundle\Entity\Membre $membre = null)
	{
		$this->membre = $membre;
		return $this;
	}
	/**
	* Get membre
	*
	* @return \AppBundle\Entity\Membre
	*/
	public function getMembre()
	{
		return $this->membre;
	}
	/**
	* Set categorie
	*
	* @param \AppBundle\Entity\Categorie $categorie
	*
	* @return Article
	*/
	public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
	{
		$this->categorie = $categorie;
		return $this;
	}
	/**
	* Get categorie
	*
	* @return \AppBundle\Entity\Categorie
	*/
	public function getCategorie()
	{
		return $this->categorie;
	}
	/**
	* Add tag
	*
	* @param \AppBundle\Entity\Tags $tag
	*
	* @return Article
	*/
	public function addTag(\AppBundle\Entity\Tag $tag)
	{
		$this->tags[] = $tag;
		return $this;
	}
	/**
	* Remove tag
	*
	* @param \AppBundle\Entity\Tags $tag
	*/
	public function removeTag(\AppBundle\Entity\Tag $tag)
	{
		$this->tags->removeElement($tag);
	}
	/**
	* Get tags
	*
	* @return \Doctrine\Common\Collections\Collection
	*/
	public function getTags()
	{
		return $this->tags;
	}
}
