<?php

namespace CRAMauth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

//use Zend\View\Model\JsonModel;


class UserController extends AbstractActionController
{
    /*protected $acceptMapping = array(
        'Zend\View\Model\JsonModel' => array(
            'application/json'
        )
    );
    $viewModel = $this->acceptableViewModelSelector($this->acceptMapping);
    return $viewModel;*/

    public function indexAction()
    {
        return new JsonModel();
    }

    public function getUserIdentity($email)
    {
        // @todo : add interface for this in order to keep modular structure
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $queryResult = $dbAdapter->query('SELECT * FROM users WHERE email = ? AND user_role = ?')
                                 ->execute(array($email, 'admin'));

        return $queryResult->current();
    }

    public function logoutAction()
    {
        // @todo : make redirect url configurable & others...
        $userSession = new Container('userSession');
        $userSession->isLogged = false;

        return $this->redirect()->toRoute('admin');
    }

    public function loginAction()
    {
        $view = new ViewModel();
        $userSession = new Container('userSession');

        $request = $this->getRequest();

        if ( $request->isPost() ) {
            $post = $request->getPost();

            if ( false !== ($user = $this->getUserIdentity($post['email'])) ) {
                $hmacValue = hash_hmac('sha512', $post['challenge'], $user['password']);

                if ( $hmacValue === $post['password']) {
                    $userSession->isLogged = true;
                    return $this->redirect()->toRoute('admin');
                }
            } else {
                // @todo : unable to find user
                $userSession->isLogged = false;
            }
        }

        if ( true === $userSession->challengeExpired ) {
            $this->__regenerateChallenge();
        }

        $view->loginChallenge = $userSession->challengeHash;
        $userSession->challengeExpired = true;

        return $view;
    }

    private function __regenerateChallenge()
    {
        // generate challenge string
        $userSession = new Container('userSession');

        $challengeHash = '';
        for ($a=1; $a<=20; $a++) {
            $challengeHash .= chr(mt_rand(48,125));
        }
        $userSession->challengeExpired = false;
        $userSession->challengeHash = $challengeHash;
    }
}