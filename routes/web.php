<?php

use Bramus\Router\Router;

$router = new Router();

$router->get('/', function() {
    echo 'Home route form router';
});

$router->get('/home', '\App\Controllers\AuthController@home');
$router->get('/register', '\App\Controllers\AuthController@register');
$router->post('/register', '\App\Controllers\AuthController@register');
$router->get('/login', '\App\Controllers\AuthController@login');
$router->post('/login', '\App\Controllers\AuthController@login');

$router->get('/test', '\App\Controllers\GuestController@index');
$router->get('/test/{$slug}', '\App\Controllers\GuestController@show');

$router->run();