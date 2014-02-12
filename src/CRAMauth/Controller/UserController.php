<?php

namespace CRAMauth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\View\Model\JsonModel;


class UserController extends AbstractActionController
{
    private $_challenge = array('hash' =>  '',
                                'expired' => false
                               );

    /*protected $acceptMapping = array(
        'Zend\View\Model\JsonModel' => array(
            'application/json'
        )
    );
    $viewModel = $this->acceptableViewModelSelector($this->acceptMapping);
    return $viewModel;*/

    public function indexAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        // Configure the instance with constructor parameters...
        /*$authAdapter = new AuthAdapter($dbAdapter,
            'users',
            'username',
            'password'
        );*/

        // ...or configure the instance with setter methods
        $authAdapter = new AuthAdapter($dbAdapter);

        $authAdapter->setTableName('users')
                    ->setIdentityColumn('email')
                    ->setCredentialColumn('password');

        $authAdapter->setIdentity('my_username')
                    ->setCredential('my_password');

        // Print the identity
        // echo $authAdapter->getIdentity() . "\n\n";

        // Print the result row
        // echo 'asdad';
        // var_dump(get_class_methods($authAdapter));
        // var_dump($authAdapter->authenticate());

        //var_dump($authAdapter);
        // exit;

        // var_dump($dbAdapter);
         /*   $arr = array('edno' => 2, 'asd' => array(123 => 'asdasd'));
        $a = new \ArrayIterator($arr);
        $a->offsetSet('someGoodie', 'extra');
        $a->offsetSet('__challenge', $this->_generateChallenge());*/

        return new JsonModel(array());
    }

    public function getChallengeAction()
    {
    }

    private function _generateChallenge()
    {
        $this->_challenge['hash'] = '';
        $this->_challenge['expired'] = true;

        for ($a=1; $a<=20; $a++) {
            $this->_challenge['hash'] .= chr(mt_rand(48,125));
        }

        $this->_challenge['expired'] = false;
        return $this->_challenge['hash'];
    }
}