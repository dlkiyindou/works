<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 01:43
 */

namespace Works\Controller;


use Works\Configuration;
use Works\Entity\User;
use Works\Service\AuthService;

class AuthController extends Controller
{

    /** @var AuthController */
    private static $instance;

    /**
     * @return AuthController
     */
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new AuthController();
        }

        return static::$instance;
    }

    public static function getShortName()
    {
        return 'auth';
    }

    public function loginAction(array $args = []) {
        if ($this->checkAuthentication()) {
            $this->redirect('index.php');
        }

        if ('POST' === filter_input(INPUT_SERVER, 'REQUEST_METHOD')) {
            $password = filter_input(INPUT_POST, 'password');
            $username = filter_input(INPUT_POST, 'username');

            if (!empty($password) && !empty($username)) {
                $user = AuthService::getInstance()->login($username, $password);
                if ($user instanceof User) {
                    throw new \Exception('Authentication error');
                }
            }
        }

        $this->display('auth', 'login');
    }

    public function logoutACtion(array $args = []) {
        AuthService::getInstance()->logout();

        $this->redirect('index.php?controller=auth&action=login');
    }
}