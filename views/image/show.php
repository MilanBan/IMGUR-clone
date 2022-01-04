<?php

?>
    <h1>THIS IS IMAGE PAGE</h1>
    <h1 class="text-center m-5"><?= $data['image']->file_name; ?></h1>
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-center">
            <?php if (isset($data['image'])) : ?>
                <div class="m-5 align-self-center">
                    <div class="d-flex m-3">
                        <img class="img-fluid" src="<?= $data['image']->file_name ?>">
                    </div>
                </div>
            <?php else: ?>
                <h1>No image</h1>
            <?php endif; ?>
        </div>
    </div>
