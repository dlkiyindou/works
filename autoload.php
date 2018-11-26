<?php
/**
 * Created by PhpStorm.
 * User: Dixi
 * Date: 20/11/2018
 * Time: 00:27
 */

spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    array_shift($parts);
    $className = array_pop($parts);

    $path = '';
    foreach ($parts as $part) {
        $path .= strtolower($part) . DIRECTORY_SEPARATOR;
    }

    $path = __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $path  . $className . '.php';
    if ($path !== '' && file_exists($path)) {
        require $path;
    }
});