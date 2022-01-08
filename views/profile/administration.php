<?php

use Core\Session;

?>

<div class="container">
    <form method="post" action="/profile/administration/<?= $data['user']->id ?>" >
        <input type="hidden" id="id" value="<?= $data['user']->id ?>">
        <?php if (Session::get('user')->id == $data['user']->id || Session::get('user')->role == 'admin') : ?>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" value="admin" <?= $data['user']->role == 'admin' ? 'checked' : '' ?> >
            <label class="form-check-label" >
                Admin
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" value="moderator" <?= $data['user']->role == 'moderator' ? 'checked' : '' ?> >
            <label class="form-check-label" >
                Moderator
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" value="user" <?= $data['user']->role == 'user' ? 'checked' : '' ?> >
            <label class="form-check-label" >
                User
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <?php endif; ?>
    </form>
</div>
