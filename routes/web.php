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
$router->get('/galleries/{$id}/images/create', '\App\Controllers\ImageController@create');
$router->get('/images/{$slug}/edit', '\App\Controllers\ImageController@edit');
$router->get('/images/{$slug}', '\App\Controllers\ImageController@show');
$router->post('/images', '\App\Controllers\ImageController@store');
$router->post('/images/{$id}/update', '\App\Controllers\ImageController@update');

// Profile
$router->get('/profile/{$username}', '\App\Controllers\ProfileController@index');

// Gallery
$router->get('/galleries/create', '\App\Controllers\GalleryController@create');
$router->post('/galleries', '\App\Controllers\GalleryController@store');
$router->get('/galleries/{$slug}/edit', '\App\Controllers\GalleryController@edit');
$router->post('/galleries/{$id}/update', '\App\Controllers\GalleryController@update');
$router->get('/galleries/{$slug}', '\App\Controllers\GalleryController@show');
$router->delete('/galleries/{$id}', '\App\Controllers\GalleryController@delete');

// Guest
$router->get('/', '\App\Controllers\GuestController@index');

$router->run();