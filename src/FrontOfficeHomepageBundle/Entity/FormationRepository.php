<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FormationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FormationRepository extends EntityRepository
{
	public function getLastFormations()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT f  
			FROM FrontOfficeHomepageBundle:Formation f
			ORDER BY f.createdAt DESC');
		
		return $query ->getResult();
	}

	public function getFormations($formationType)
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT f  
			FROM FrontOfficeHomepageBundle:Formation f
			WHERE f.formationType = :type')
		->setParameter('type', $formationType);
		
		return $query ->getResult();
	}




}
