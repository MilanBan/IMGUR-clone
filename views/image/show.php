<?php

use Core\Session;

?>

<?php if (isset($data['image'])) : ?>
    <div class="border-bottom rounded-pill">
        <?php if (Session::get('user')->id == $data['image']->user_id || in_array(Session::get('user')->role, ['moderator', 'admin'])) : ?>
            <div class="btn-group d-flex justify-content-around m-5">
                <a class="btn btn-sm btn-warning" href="/images/<?= $data['image']->slug . '/edit' ?>">Edit</a>
                <?php if (Session::get('user')->id == $data['image']->user_id || Session::get('user')->role == 'admin') : ?>
                    <a class="btn btn-sm btn-danger" type="button" id="delete-gallery" data-id="<?= $data['images']->id ?>">Delete</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
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
