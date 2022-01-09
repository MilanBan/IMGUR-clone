<?php

use Core\Session;
var_dump(Session::get('user')->role);
?>

<div class="container">
    <?php if ($_SERVER['REQUEST_URI'] == '/') : ?>
    <h1>Welcome <?= (isset(Session::get('user')->username)) ? Session::get('user')->username : ' to IMGUR';  ?></h1>
    <?php elseif ($_SERVER['REQUEST_URI'] == '/imgur/galleries') : ?>
    <h1>List of other user galleries</h1>
    <?php elseif ($_SERVER['REQUEST_URI'] == '/imgur/profiles') : ?>
    <h1>List of other user profiles</h1>
    <?php endif; ?>
</div>
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-center">
      <?php if (isset($data['images'])) : ?>
        <?php foreach ($data['images'] as $image) : ?>
            <div class="d-flex flex-column">
                <div class="d-flex m-3">
                    <?php if (Session::get('user')) : ?>
                        <a class="mx-auto" href="http://localhost:8080/images/<?= $image->slug ?> ">
                    <?php else: ?>
                        <a class="mx-auto" href="/login">
                    <?php endif; ?>
                        <img class="img-fluid rounded" src="<?= $image->file_name ?>">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <div class="d-flex flex-wrap justify-content-center">
        <?php if (isset($data['galleries'])) : ?>
            <?php foreach ($data['galleries'] as $gallery) : ?>
                <div class="d-flex flex-column" style="width: 12rem;">
                    <div class="d-flex m-3">
                        <?php if (Session::get('user')) : ?>
                        <a class="mx-auto" href="http://localhost:8080/galleries/<?= $gallery->slug ?> ">
                            <?php else: ?>
                            <a class="mx-auto" href="/login">
                                <?php endif; ?>
                                <img class="img-fluid rounded" src="<?= $data['cover'][$gallery->id] ?>">
                                <p> <?= $gallery->name ?></p>
                            </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <?php if (isset($data['users'])) : ?>


    <?php endif; ?>
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-center">
            <?php if (isset($data['users'])) : ?>
                <table class="table table-hover table-bordered w-70">
                    <thead>
                    <tr>
                        <th scope="col">
                            User Profile
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['users'] as $user) : ?>
                        <tr>
                            <th scope="row">
                                <div class="container">
                                    <div class="row justify-content-between">

                                    <a class="col-4" href="http://localhost:8080/profile/<?= \App\Helper::encode($user->username) ?> ">
                                        <?= $user->username ?>
                                    </a>
                                        <?php if(in_array(Session::get('user')->role, ['admin', 'moderator'])) : ?>
                                    <a class="btn btn-warning btn-sm col-4" href="http://localhost:8080/profile/administration/<?= $user->id ?>" >
                                        Change Role (<small><?= $user->role ?></small>)
                                    </a>
                                        <?php endif; ?>

                                    </div>
                                </div>

                            </th>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
