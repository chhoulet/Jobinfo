<?php

namespace FrontOfficeEmploiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ResponseJobOfferRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResponseJobOfferRepository extends EntityRepository
{
	public function getJobOfferResponse($candidat_id)
	{
		$query = $this -> getEntityManager()-> createQuery('
			SELECT r 
			FROM FrontOfficeEmploiBundle:ResponseJobOffer r 
			JOIN  r.candidat c
			WHERE c.id LIKE :id')
		->setParameter('id', $candidat_id);

		return $query -> getResult();
	}

}
