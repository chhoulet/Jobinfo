<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * JobOfferRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobOfferRepository extends EntityRepository
{
	public function getJobOffers()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT j 
			FROM FrontOfficeEmploiBundle:JobOffer j 
			WHERE j.activeToPurchase = true
			ORDER BY j.dateCreated DESC')
		->setMaxResults(10);

		return $query -> getResult();
	}

	public function nbJobOffers()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT COUNT(j.id)
			FROM FrontOfficeEmploiBundle:JobOffer j');

		return $query -> getSingleSCalarResult();
	}

	public function triJobOffers($contract, $jobSector, $place)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT j 
			FROM FrontOfficeEmploiBundle:JobOffer j 
			JOIN j.jobSector jbs
			JOIN j.place p
			WHERE j.contract LIKE :contract
			AND p.name LIKE :place
			AND j.activeToPurchase = true
			AND jbs.nameSector LIKE :jobSector
			ORDER BY j.dateCreated DESC')
		->setParameter('contract', $contract)
		->setParameter('jobSector', $jobSector)
		->setParameter('place', $place);

		return $query -> getResult();
	}

	public function getNbJobOffersPurchased()
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT COUNT(j.id)
			FROM FrontOfficeEmploiBundle:JobOffer j 
			WHERE j.activeToPurchase = false');

		return $query -> getSingleScalarResult();
	}

	public function getNbJobOffersByUser($user)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(j.id) AS nb 
			FROM FrontOfficeEmploiBundle:JobOffer j 
			JOIN j.user u
			WHERE u.id LIKE :user')
		->setParameter('user', $user);

		return $query -> getSingleScalarResult();
	}

	public function getNbJobOffersBySociety($id)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(j.id) AS nb 
			FROM FrontOfficeEmploiBundle:JobOffer j 
			JOIN j.society s 
			WHERE s.id LIKE :idSociety')
		->setParameter('idSociety', $id);

		return $query -> getSingleScalarResult();
	}

	public function getNbActiveJobOffersBySociety($id)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT COUNT(j.id) AS nb 
			FROM FrontOfficeEmploiBundle:JobOffer j 
			JOIN j.society s 
			WHERE s.id LIKE :idSociety
			AND j.activeToPurchase = true')
		->setParameter('idSociety', $id);

		return $query -> getSingleScalarResult();
	}

	public function getAverageNbResponseJobOfferByJobOffer($id)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT AVG(r.id)
			FROM FrontOfficeEmploiBundle:ResponsejobOffer r
			JOIN r.jobOffer j');

		return $query -> getSingleScalarResult();
	}
}
