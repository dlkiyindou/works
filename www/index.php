<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 25/11/2018
 * Time: 18:17
 */

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '/autoload.php';

try {
    $controllerName = filter_input(INPUT_GET, 'controller');
    if ($controllerName === null) {
        $controllerName = \Works\Controller\PostController::getShortName();
        $actionName = 'index';
    } else {
        $actionName = filter_input(INPUT_GET, 'action');
    }

    $args = (array)filter_input_array(INPUT_GET);

    $controller = \Works\Configuration::getInstance()->getController($controllerName);
    $controller->handle($actionName, $args);

} catch (\Exception $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
}