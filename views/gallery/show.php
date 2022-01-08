<?php

use Core\Session;

?>

<?php if (isset($data['gallery'])) : ?>
<div class="border-bottom rounded-pill">
    <h1 class="text-center m-5">Gallery: <strong><?= $data['gallery']->name; ?></strong></h1>
    <p class="text-center m-3"><?= $data['gallery']->description; ?></p>
    <?php if (Session::get('user')->id == $data['gallery']->user_id || in_array(Session::get('user')->role, ['moderator', 'admin'])) : ?>
        <div class="btn-group d-flex justify-content-around m-5">
            <?php if (Session::get('user')->id == $data['gallery']->user_id) : ?>
                <a class="btn btn-sm btn-success" href="/galleries/<?= $data['gallery']->id ?>/images/create">Add Image</a>
            <?php endif; ?>
                <a class="btn btn-sm btn-warning" href="/galleries/<?= $data['gallery']->slug . '/edit' ?>">Edit</a>
            <?php if (Session::get('user')->id == $data['gallery']->user_id || Session::get('user')->role != 'moderator') : ?>
                <a class="btn btn-sm btn-danger" type="button" id="delete-gallery" data-id="<?= $data['gallery']->id ?>">Delete</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>
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
    <div class="d-flex flex-wrap justify-content-start">
        <div class="flex-column">
            <div class="flex-column p-3 mb-5">
                <h2>Comments:</h2>
            </div>
        <?php if (isset($data['comments'])) : ?>
            <?php foreach ($data['comments'] as $comment) : ?>
                <div class="d-flex shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <h5 class="p-3"><?= $comment->username ?></h5>
                        <p class="m-3"><?= $comment->comment ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="container">
        <form method="post" action="/comments">
            <input type="hidden" name="gallery_id" value="<?= $data['gallery']->id ?>">
            <?php if (Session::get('user')->id) : ?>
            <div class="form-group mb-3">
                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Leave a comment.."></textarea>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php endif; ?>
        </form>
        </div>
</div>
