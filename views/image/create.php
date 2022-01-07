<?php
?>
<div class="d-flex justify-content-center mt-5 ">
        <form method="post" action="/images">
            <input type="hidden" name="gallery_id" value="<?= $data['gallery_id'] ?>">
            <div class="form-group mb-3">
                <input type="text" name="file_name" class="form-control <?= (isset($data['errors']['file_name'])) ? 'is-invalid' : 'is-valid' ?>" placeholder="Enter Image url address" value="<?= $data['image']->file_name ?? '' ?>">
            </div>
            <?php if (isset($data['errors']['file_name'])) : ?>
                <div class="mb-3">
                    <small class="text-danger">
                        <?= $data['errors']['file_name'] ?>
                    </small>
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
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
</div>

