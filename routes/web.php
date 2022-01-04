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

// Image
$router->get('/images/{$slug}', '\App\Controllers\ImageController@show');

// Profile
$router->get('/profile/{$username}', '\App\Controllers\ProfileController@index');

// Gallery
$router->get('/galleries/{$slug}/edit', '\App\Controllers\GalleryController@edit');
$router->post('/galleries/{$id}/update', '\App\Controllers\GalleryController@update');
$router->get('/galleries/{$slug}', '\App\Controllers\GalleryController@show');
$router->delete('/galleries/{$id}', '\App\Controllers\GalleryController@delete');

// Guest
$router->get('/', '\App\Controllers\GuestController@index');

$router->run();