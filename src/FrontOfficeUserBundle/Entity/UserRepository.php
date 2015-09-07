<?php

namespace FrontOfficeUserBundle\Entity;

use Doctrine\ORM\EntityRepository; 

class UserRepository extends EntityRepository
{
	public function getNbCommentsByUser()
	{
		$query = $this -> getEntitymanager()-> createQuery('
			SELECT u.username, COUNT(c.id) AS nb 
			FROM FrontOfficeUserBundle:User u 
			JOIN u.comment c  
			WHERE c.validAdmin = true
			GROUP BY u.username
			ORDER BY nb DESC');

		return $query -> getResult(); 
	}
}