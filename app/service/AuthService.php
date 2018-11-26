<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 20:39
 */

namespace Works\Service;

use Works\Configuration;
use Works\Entity\User;

class AuthService
{
    /** @var AuthService */
    private static $instance;

    /**
     * @return AuthService
     */
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new AuthService();
        }

        return static::$instance;
    }

    public function checkAuthentication() {
        @session_start();
        session_regenerate_id();
        return isset($_SESSION['user']);
    }

    public function login($username, $password) {
        /** @var UserService $userService */
        $userService = UserService::getInstance();
        $user = $userService->getByUserName($username);

        if (!$user instanceof User) {
            $user = $userService->create($username, $password);
        }

        if (hash_equals($user->getPassword(), sha1($password))) {
            if (session_status() !== PHP_SESSION_ACTIVE)
                session_start();

            $_SESSION['user'] = $user->getUserName();
            $user->setIsConnected(true);
            $userService->save($user);

            return $user;
        }

        return null;
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();

        $user = $this->getCurrentUser();
        $user->setIsConnected(false);

        $userService = UserService::getInstance();
        $userService->save($user);
        unset($_SESSION['user']);
        session_destroy();
    }

    /**
     * @return null|User
     */
    public function getCurrentUser() {
        $user = null;
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user'];
            $userService = UserService::getInstance();
            $user = $userService->getByUserName($username);
        }

        return $user;
    }
}