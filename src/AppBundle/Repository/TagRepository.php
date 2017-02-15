<?php
namespace AppBundle\Repository;
/**
 * TagRepository
 *
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{

	/**
	* Retourne un tag
	* @param id identifiant du tag
	* @return int
	**/
	public function getTagById($id)
	{
		$query = $this->createQueryBuilder('t')
			->setParameter('id', $id)
			->where('t.id = :id')
			->getQuery();
		return $query->getSingleResult();
	}

	/**
	*
	* Retourne la liste des tags
	*
	**/

	public function getAllTags()
	{
		$query = $this->createQueryBuilder('t')
				  ->getQuery();
		return $query->getResult();
	}

}
