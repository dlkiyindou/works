<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 01:14
 */

namespace Works\Controller;

use Works\Configuration;
use Works\Service\AuthService;

abstract class Controller
{
    /**
     * @param $action
     * @param array $params
     * @return string
     */
    protected function render($action, array $params) {
        foreach ($params as $name => $value) {
            ${$name} = $value;
        }

        return require Configuration::getInstance()->getView(static::getShortName(), $action);
    }

    /**
     * @return string
     */
    public static function getShortName() {
        return '';
    }

    public function handle($action, array $params) {
        $method = $action . 'Action';

        if (method_exists($this, $method)) {
            $this->beforeHandle($action);
            $this->$method($params);
            $this->afterHandle($action);
        }
    }

    /**
     * @return bool
     */
    protected function checkAuthentication() {
        $authService = AuthService::getInstance();
        return $authService->checkAuthentication();
    }

    protected function beforeHandle($actionName) {
        if (!$this->checkAuthentication() && $actionName != 'login') {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    protected function afterHandle($actionName) {

    }

    protected function redirect($url) {
        header('location:' . $url);
        die;
    }

    protected function displayActionView($actionName) {
        return Configuration::getInstance()->getView(static::getShortName(), $actionName);
    }

    protected function display ($controllerName, $actionName, array $params = []) {
        foreach ($params as $key => $value) {
            ${$key} = $value;
        }

        if ($this->checkAuthentication()) {
            $currentUser = AuthService::getInstance()->getCurrentUser();
        }

        ob_clean();
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' .DIRECTORY_SEPARATOR . 'layout.php';
        ob_flush();
    }
}