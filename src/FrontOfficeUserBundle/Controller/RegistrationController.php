<?php

namespace FrontOfficeUserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
    public function registerAction()
    {
        $response = parent::registerAction();

        $personnalSpaceActive ->setPersonnalSpaceActive(false);

        return $response;
    }
}