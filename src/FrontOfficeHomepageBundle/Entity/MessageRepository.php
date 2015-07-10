<?php

namespace FrontOfficeHomepageBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{
	public function getMessages()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT m 
			FROM FrontOfficeHomepageBundle:Message m 
			WHERE m.readMessage = false
			ORDER BY m.dateCreated DESC');
		return $query -> getResult();
	}

	public function getMessagesRead()
	{
		$query = $this -> getEntityManager()->createQuery('
			SELECT m 
			FROM FrontOfficeHomepageBundle:Message 
			WHERE m.readMessage = true 
			ORDER BY m.dateCreated DESC');
		return $query -> getResult();
	}
}