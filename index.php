<?php

session_start();

spl_autoload_register(function($class) {
    require_once lcfirst(str_replace('\\', '/', $class)) . '.php';
});

$router = new App\Router();
$router->getRouteFromQuery();
