<?php

use Core\Session;

?>
<h1>THIS IS USER GALLERY PAGE</h1>
<h1 class="display-1 text-center m-5"><?= $data['gallery']->name; ?></h1>
<p class="text-center m-5"><?= $data['gallery']->description; ?></p>
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-center">
        <?php if (isset($data['images'])) : ?>
            <?php foreach ($data['images'] as $image) : ?>
                <div class="d-flex flex-column">
                    <div class="d-flex m-3">
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
