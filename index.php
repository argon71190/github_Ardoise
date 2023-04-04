<?php

//Errors display
error_reporting(E_ALL);
ini_set('display_errors', 1);

//setlocale(LC_CTYPE, 'fr_FR.UTF8');
setlocale(LC_TIME, 'fr_FR', 'fra');
date_default_timezone_set('Europe/Paris');
mb_internal_encoding('UTF-8');

session_start();

spl_autoload_register(function($class) {
    require_once lcfirst(str_replace('\\', '/', $class)) . '.php';
});

$router = new App\Router();
$router->getRouteFromQuery();