<?php

use Bramus\Router\Router;

$router = new Router();

$router->get('/test', function() {
    echo 'Home route form router.';
});

// Auth
$router->get('/register', '\App\Controllers\AuthController@register');
$router->post('/register', '\App\Controllers\AuthController@register');
$router->get('/login', '\App\Controllers\AuthController@login');
$router->post('/login', '\App\Controllers\AuthController@login');
$router->get('/logout', '\App\Controllers\AuthController@logout');

$router->get('/home', '\App\Controllers\AuthController@home');
// Image
$router->get('/images/{$slug}', '\App\Controllers\ImageController@show');

// Profile
$router->get('/profile/{$username}', '\App\Controllers\ProfileController@index');

// Gallery
$router->get('/galleries/{$slug}', '\App\Controllers\GalleryController@show');

// Guest
$router->get('/', '\App\Controllers\GuestController@index');
$router->get('/{$slug}', '\App\Controllers\GuestController@show');

$router->run();