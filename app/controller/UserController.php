<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 01:13
 */

namespace Works\Controller;


class UserController extends Controller
{
    /** @var UserController */
    private static $instance;

    /**
     * @return UserController
     */
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new UserController();
        }

        return static::$instance;
    }

    public static function getShortName()
    {
        return 'user';
    }

    public function editAction() {

    }
}