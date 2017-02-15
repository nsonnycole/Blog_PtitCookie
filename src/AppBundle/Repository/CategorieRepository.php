<?php
namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * CategorieRepository
 *
 */
class CategorieRepository extends EntityRepository
{

	/**
	* Retourne une catéorie d'article
	* @param id identifiant de la catégorie
	* @return int
	**/
	public function getCatById($id)
	{
		$query = $this->createQueryBuilder('categorie')
			->setParameter('id', $id)
			->where('categorie.id = :id')
			->getQuery();
		return $query->getResult();
	}

	/**
	*
	* Retourne la liste des articles correspondant à une catégorie
	*
	**/

	public function getArticles($categorie)
	{
		$query = $this->createQueryBuilder('c')
			->setParameter('categorie', $categorie)
			->where('c.categorie = :categorie')
			->orderBy('c.datePost', 'DESC')
			->setMaxResults(10)
			->getQuery();
		return $query->getSingleResult();
	}

	/**
	*
	* Retourne la liste des catégories
	*
	**/
	public function getAllCategories()
	{
		$query = $this->createQueryBuilder('c')
				  ->getQuery();
		return $query->getResult();
	}

}
