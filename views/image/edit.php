<?php

use Core\Session;

?>

<div class="container">
 <form method="post" action="../<?= $data['image']->id ?>/update">
    <input type="hidden" id="id" value="<?= $data['image']->id ?>">
    <?php if (Session::get('user')->id == $data['image']->user_id || Session::get('user')->role != 'moderator') : ?>
        <div class="form-group mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" value="<?= $data['image']->slug ?>">
        </div>
    <?php endif; ?>
     <div class="form-check form-check-inline">
      <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox"
               name="hidden" <?= ($data['image']->hidden == '1' ? 'checked' : '') ?> >
        <label class="form-check-label" for="hidden">Hidden</label>
      </div>
      <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox"
               name="nsfw" <?= ($data['image']->nsfw == '1' ? 'checked' : '') ?> >
        <label class="form-check-label" for="nsfw">NSFW</label>
      </div>
     </div>
    <button type="submit" class="btn btn-primary">Update</button>
 </form>
</div>
