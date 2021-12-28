<?php

use Bramus\Router\Router;

$router = new Router();

$router->get('/', function() {
    echo 'Home route form router';
});

$router->run();