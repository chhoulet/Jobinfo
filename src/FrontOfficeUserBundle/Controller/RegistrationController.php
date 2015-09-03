<?php

namespace FrontOfficeUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
	public function registerAction(Request $request)
	{
		$user -> setPersonnalSpaceActive(false);
	}
}