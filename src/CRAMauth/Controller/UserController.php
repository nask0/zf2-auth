<?php

namespace CRAMauth\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }
}