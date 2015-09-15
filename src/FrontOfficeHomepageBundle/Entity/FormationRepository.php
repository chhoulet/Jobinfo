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
	# Obtenir la dernière formation enregistrée sur le site :
	public function getLastFormations()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT f  
			FROM FrontOfficeHomepageBundle:Formation f
			ORDER BY f.createdAt DESC')
		->setMaxResults(1);
		
		return $query ->getResult();
	} 

	# Obtenir les formations d'un seul type:
	public function getFormations($formationType)
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT f  
			FROM FrontOfficeHomepageBundle:Formation f
			WHERE f.formationType = :type')
		->setParameter('type', $formationType);
		
		return $query ->getResult();
	}

	# # Obtenir le nombre de formations par type (integration, developpement, ...)
	public function getNbFormationByType()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT f.formationName, COUNT(f.id)  as nb 
			FROM FrontOfficeHomepageBundle:Formation f 
			GROUP BY f.formationType
			ORDER BY nb DESC');

		return $query ->getResult();
	}

	# Obtenir les formations par type (integration, developpement, ...)
	public function getFormationType()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT f 
			FROM FrontOfficeHomepageBundle:Formation f 
			GROUP BY f.formationType');

		return $query ->  getResult();
	}

	# Nombre total de formations enregistrées:
	public function nbFormations()
	{
		$query = $this -> getEntityManager() -> createQuery('
			SELECT COUNT(f.id)
			FROM FrontOfficeHomepageBundle:Formation f');

		return $query -> getSingleScalarResult();
	}

	# Nombre d'inscrits à chaque formation:
	public function getNbUsersByFormation()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT f.formationName, f.id, f.formationType, COUNT(i.id) AS nb
			FROM FrontOfficeHomepageBundle:Formation f 
			JOIN f.inscrits i
			GROUP BY f.formationName
			ORDER BY nb DESC');

		return $query ->getResult();
	}

	# Liste des inscrits a chaque formation:
	public function getInscritsByFormation()
	{
		$query = $this ->getEntityManager()->createQuery('
			SELECT f.formationName, f.formationType, f.id, i.username, i.email, COUNT(i.id) AS nb 
			FROM FrontOfficeHomepageBundle:Formation f 
			JOIN f.inscrits i 
			GROUP BY f.formationName, f.formationType, f.id
			ORDER BY nb DESC');

		return $query -> getResult();
	}

	public function getFormationByInscrit($formation_id, $user)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT f 
			FROM FrontOfficeHomepageBundle:Formation f 
			JOIN f.inscrits i 
			WHERE i.id LIKE :user
			AND f.id LIKE :formation_id')
		->setParameter('user', $user)
		->setParameter('formation_id', $formation_id);

		return $query -> getResult();
	}
}
