<?php

spl_autoload_register('autoLoader');

function autoLoader($className) {
    $url = $_SERVER['HTTP_POST'].$_SERVER['REQUEST_URI'];

    if (strpos($url, 'includes') !== false) {
        $path = '../classes/';
    } else {
        $path = 'classes/';
    }

    $exntension = '.class.php';
    require_once $path . $className . $exntension;
}