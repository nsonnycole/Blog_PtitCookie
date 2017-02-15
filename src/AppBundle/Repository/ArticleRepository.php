<?php
namespace AppBundle\Repository;
/**
 * ArticleRepository
 *
 **/

class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	* Retourne un article
	* @param id identifiant du article
	* @return int
	**/

	public function getById($id)
	{
		$query = $this->createQueryBuilder('a')
			->setParameter('id', $id)
			->where('a.id = :id')
			->getQuery();
		return $query->getSingleResult();
	}

	/**
	*
	* Retourne la liste des articles
	*
	**/

	public function getAllArtcicles()
	{
		$query = $this->createQueryBuilder('a')
   				->orderBy('a.datePost', 'DESC')
					->setMaxResults(5)
				  ->getQuery();
		return $query->getResult();
	}

	/**
	*
	* Retourne la liste des articles en fonction du paramètre champs
	*
	**/

	public function rechercheArticleByParametres($champs)
	{
		$query = $this->createQueryBuilder('a')
					->setParameter('champs', $champs)
					->where('a.titre = :champs')
					->orWhere('a.description = :champs')
					->getQuery();
				return $query->getResult();
	}

}
