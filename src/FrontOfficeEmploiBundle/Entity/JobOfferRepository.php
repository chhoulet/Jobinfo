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

	public function triJobOffers($contract, $jobSector)
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT j 
			FROM FrontOfficeEmploiBundle:JobOffer j 
			JOIN j.jobSector jbs
			WHERE j.contract c LIKE :contract
			AND j.activeToPurchase = true
			AND jbs.nameSector LIKE :jobSector
			ORDER BY j.dateCreated DESC')
		->setParameter('contract', $contract)
		->setParameter('jobSector', $jobSector);

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
}
