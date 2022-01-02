<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>IMGUR</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="/home">IMGUR</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/profile/<?= \Core\Session::get('user')->id; ?>">Profile <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/test">Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Guest</a>
            </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <?php if (\Core\Session::get('user')): ?>
            <li class="nav-item active">
                <a class="nav-link" href="/logout">Logout <span class="sr-only">(current)</span></a>
            </li>
            <?php else: ?>
                <li class="nav-item active">
                    <?php if ($_SERVER['REQUEST_URI'] !== '/login'): ?>
                        <a class="nav-link" href="/login">Login <span class="sr-only">(current)</span></a>
                    <?php endif ?>
                </li>
                <li class="nav-item active">
                    <?php if ($_SERVER['REQUEST_URI'] !== '/register'): ?>
                        <a class="nav-link" href="/register">Register</a>
                    <?php endif ?>
                </li>
            <?php endif ?>
        </ul>
    </div>
</nav>
<div class="container-fluid m-5">
