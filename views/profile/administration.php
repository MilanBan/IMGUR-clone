<?php

use Core\Session;

?>

<div class="container">
    <form method="post" action="/profile/administration/<?= $data['user']->id ?>" >
        <input type="hidden" id="id" value="<?= $data['user']->id ?>">
        <?php if ((Session::get('user')->id == $data['user']->id) || in_array(Session::get('user')->role, ['admin', 'moderator'])) : ?>

            <div class="form-check form-check-inline">
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox"
                           name="active" <?= ($data['user']->active == '1' ? 'checked' : '') ?> >
                    <label class="form-check-label" for="hidden">Active</label>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox"
                           name="nsfw" <?= ($data['user']->nsfw == '1' ? 'checked' : '') ?> >
                    <label class="form-check-label" for="nsfw">NSFW</label>
                </div>
            </div>

        <?php endif; ?>
          <?php if (Session::get('user')->role == 'admin') : ?>
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
          <?php endif; ?>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
