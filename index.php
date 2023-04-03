<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


spl_autoload_register(function($class) {
    require_once lcfirst(str_replace('\\', '/', $class)) . '.php';
});

$router = new App\Router();
$router->getRouteFromQuery();
