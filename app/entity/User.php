<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 21:46
 */

namespace Works\Entity;


class User extends DataObject
{
    private $userName;
    private $firstName;
    private $lastName;
    private $passWord;
    private $isConnected;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id' :
                    $this->id = $value;
                    break;
                case 'username' :
                    $this->userName = $value;
                    break;
                case 'firstname' :
                    $this->firstName = $value;
                    break;
                case 'lastname' :
                    $this->lastName = $value;
                    break;
                case 'password' :
                    $this->passWord = $value;
                    break;
                case 'is_connected' :
                    $this->isConnected = $value;
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPassWord()
    {
        return $this->passWord;
    }

    /**
     * @param mixed $passWord
     */
    public function setPassWord($passWord)
    {
        $this->passWord = $passWord;
    }

    /**
     * @return mixed
     */
    public function getisConnected()
    {
        return $this->isConnected;
    }

    /**
     * @param mixed $isConnected
     */
    public function setIsConnected($isConnected)
    {
        $this->isConnected = $isConnected;
    }



    public function toArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->userName,
            'firstname' => $this->firstName,
            'lastname' => $this->lastName,
            'password' => $this->passWord,
            'is_connected' => (int)$this->isConnected
        ];
    }
}