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
	* Retourne la liste des articles en fonction du paramètre recherche
	*
	**/

	public function rechercheArticleByParametres($recherche)
	{
		$query = $this->createQueryBuilder('a')
					->setParameter('recherche', $recherche)
					->where('a.titre LIKE :recherche')
					->orWhere('a.description = :recherche')
					->getQuery();
				return $query->getResult();
	}

}
