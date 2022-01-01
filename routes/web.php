<?php

use Bramus\Router\Router;

$router = new Router();

$router->get('/test', function() {
    echo 'Home route form router';
});

$router->get('/home', '\App\Controllers\AuthController@home');
$router->get('/register', '\App\Controllers\AuthController@register');
$router->post('/register', '\App\Controllers\AuthController@register');
$router->get('/login', '\App\Controllers\AuthController@login');
$router->post('/login', '\App\Controllers\AuthController@login');
$router->get('/logout', '\App\Controllers\AuthController@logout');

$router->get('/profile/image/{$slug}', '\App\Controllers\ProfileController@show');
$router->get('/profile/{$id}', '\App\Controllers\ProfileController@index');

$router->get('/', '\App\Controllers\GuestController@index');
$router->get('/{$slug}', '\App\Controllers\GuestController@show');



$router->run();