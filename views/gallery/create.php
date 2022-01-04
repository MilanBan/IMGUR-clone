<?php
?>
<div class="d-flex justify-content-center mt-5 ">
        <form method="post" action="/galleries">
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control <?= (isset($data['errors']['name'])) ? 'is-invalid' : 'is-valid' ?>" placeholder="Enter Gallery name" value="<?= $data['gallery']->name ?? '' ?>">
            </div>
            <?php if (isset($data['errors']['name'])) : ?>
                <div class="mb-3">
                    <small class="text-danger">
                        <?= $data['errors']['name'] ?>
                    </small>
                </div>
            <?php endif; ?>
            <div class="form-group mb-3">
                <textarea class="form-control <?= (isset($data['errors']['description'])) ? 'is-invalid' : 'is-valid' ?>" name="description" placeholder="Enter Gallery description" value="<?= $data['gallery']->description ?? '' ?>"></textarea>
            </div>
            <?php if (isset($data['errors']['description'])) : ?>
                <div class="mb-3">
                    <small class="text-danger">
                        <?= $data['errors']['description'] ?>
                    </small>
                </div>
            <?php endif; ?>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
</div>

