<?php

use Core\Session;

require __DIR__ . '/includes/Header.php'

?>

<div class="container">
    <h1>THIS IS HOME PAGE</h1>
    flash msg <?= Session::getFlash('success') ?>
    <?php if (isset($data['user'])) : ?>
        <h4> Welcome <?= $data['user']->username; ?> </h4>
    <?php endif; ?>
        <h4> Welcome for get session <?= Session::get('user')->username; ?> </h4>
</div>
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-center">
        <?php if (isset($data['image'])) : ?>
            <img class="img-fluid rounded" src="<?= $data['image']->file_name ?>">
        <?php endif; ?>

        <?php if (isset($data['images'])) : ?>
        <?php foreach ($data['images'] as $image) : ?>
            <div class="d-flex flex-column">
                    <a class="mx-auto" href="http://localhost:8080/images/<?= $image->slug ?> ">
                        <img class="img-fluid rounded" src="<?= $image->file_name ?>">
                    </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/includes/Footer.php'?>
