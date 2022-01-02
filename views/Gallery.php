<?php

use Core\Session;

require __DIR__ . '/includes/Header.php'

?>
<h1>THIS IS USER GALLERY PAGE</h1>
<h1 class="display-1 text-center m-5"><?= $data['gallery']->name; ?></h1>
<p class="text-center m-5"><?= $data['gallery']->description; ?></p>
<div class="jumbotron">
    <div class="row d-flex justify-content-center m-3">
        <?php if (isset($data['images'])) : ?>
            <?php foreach ($data['images'] as $image) : ?>
                <div class="m-5 align-self-center">
                    <div class="d-flex">
                        <a class="mx-auto" href="http://localhost:8080/images/<?= $image->slug ?> ">
                            <img class="img-fluid" src="<?= $image->file_name ?>">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h1>Gallery is empty</h1>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/includes/Footer.php'?>
