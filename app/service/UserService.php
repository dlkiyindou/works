<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 21:25
 */

namespace Works\Service;


use Works\Configuration;
use Works\Entity\User;

class UserService extends AbstractEntityService
{
    const TABLE = 'user';

    /** @var UserService */
    private static $instance;
    /**
     * @return UserService
     */
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new UserService();
        }

        return static::$instance;
    }

    /**
     * @return array
     */
    public function getAllConnected() {
        $db = Configuration::getInstance()->getDB();
        $stm = $db->prepare('SELECT * FROM ' . $this->getTable() . 'WHERE is_connected = 1');
        $stm->execute();
        $results = $stm->fetchAll(\PDO::FETCH_ASSOC);

        $data = [];
        foreach ($results as $result) {
            $data[] = $this->buildEntity($result);
        }

        return $data;
    }

    /**
     * @param $username
     * @return User
     */
    public function getByUserName($username) {
        $db = Configuration::getInstance()->getDB();
        $stm = $db->prepare('SELECT * FROM ' .static::TABLE. ' WHERE username = :username');
        $stm->bindValue(':username', $username);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        if (is_array($result) && !empty($result)) {
            return new User($result);
        }

        return null;
    }

    public function create($username, $password) {
        $user = $this->buildEntity(['username' => $username, 'password' => sha1($password)]);
        $user = $this->save($user);

        return $user;
    }

    /** @return string */
    public function getTable()
    {
        return 'user';
    }

    /**
     * @param array $result
     * @return \Works\Entity\DataObject|User
     */
    public function buildEntity(array $result)
    {
        return new User($result);
    }
}