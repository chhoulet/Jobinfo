<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ForumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ForumRepository extends EntityRepository
{
	public function getLastForum()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT f 
			FROM FrontOfficeHomepageBundle:Forum f 
			ORDER BY f.forumDate DESC')
		->setMaxResults(1);
		
		return $query -> getResult();
	}

	public function getForums($forumType)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT f 
			FROM FrontOfficeHomepageBundle:Forum f 
			WHERE f.forumType = :forumType')
		->setParameter('forumType', $forumType);

		return $query -> getResult();
	}

	public function nbForums()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(f.id)
			FROM FrontOfficeHomepageBundle:Forum f 
			WHERE f.forumDate > :dateForum')
		->setParameter('dateForum', new \DateTime('now'));

		return $query -> getSingleScalarResult();
	}
}
