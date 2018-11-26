<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 00:33
 */
namespace Works;

use http\Exception\InvalidArgumentException;
use Works\Controller\AuthController;
use Works\Controller\Controller;
use Works\Controller\PostController;
use Works\Controller\UserController;

class Configuration
{
    /** @var \PDO */
    private $pdo;

    private $controllers;

    /** @var Configuration */
    private static $instance;

    /**
     * @return Configuration
     */
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new Configuration();
        }

        return static::$instance;
    }

    /**
     * @return \PDO
     */
    public function getDB () {
        if ($this->pdo === null) {
            $dbConfig = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'db.php';
            $host = $dbConfig['host'];
            $port = $dbConfig['port'];
            $dbname = $dbConfig['database'];
            $username = $dbConfig['username'];
            $password = $dbConfig['password'];

            $this->pdo = new \PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname, $username, $password);
            $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        }

        return $this->pdo;
    }

    /**
     * @param $controllerShortName
     * @param $actionShortName
     * @return string
     */
    public function getView($controllerShortName, $actionShortName) {
        return __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $controllerShortName . DIRECTORY_SEPARATOR . $actionShortName . '.php';
    }

    /**
     * @param $shortname
     * @return Controller
     * @throws InvalidArgumentException
     */
    public function getController($shortname) {
        if ($this->controllers === null) {
            $this->controllers = [
                AuthController::getShortName() => AuthController::getInstance(),
                UserController::getShortName() => UserController::getInstance(),
                PostController::getShortName() => PostController::getInstance(),
                'index' => PostController::getInstance(),
            ];
        }

        if (key_exists($shortname, $this->controllers)) {
            return $this->controllers[$shortname];
        }

        throw new InvalidArgumentException('Http request parameters are not corrects');
    }
}