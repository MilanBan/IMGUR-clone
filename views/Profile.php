<?php


use Core\Session;

require __DIR__ . '/includes/Header.php'

?>

<div class="container">
    <h1>THIS IS USER PROFILE PAGE</h1>
    <?php if (isset($data['user'])) : ?>
        <h1>User: <?= $data['user']->username; ?></h1>
        <h1>Email: <?= $data['user']->email; ?></h1>
    <?php endif; ?>
</div>
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-center">
        <?php if (isset($data['image'])) : ?>
            <img class="img-fluid rounded" src="<?= $data['image']->file_name ?>">
        <?= print_r($data['image']) ?>
        <?php endif; ?>

        <?php if (isset($data['images'])) : ?>
        <?php foreach ($data['images'] as $image) : ?>
            <div class="d-flex flex-column">
                    <a class="mx-auto" href="http://localhost:8080/profile/image/<?= $image->slug ?> ">
                        <img class="img-fluid rounded" src="<?= $image->file_name ?>">
                    </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/includes/Footer.php'?>
