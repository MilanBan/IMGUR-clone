<?php require __DIR__ . '/includes/Header.php'?>

<div class="d-flex justify-content-center mt-5 ">
<form action="/login" method="post">

    <div class="form-group">
        <input type="email" name="email" class="form-control <?= (isset($data['errors']['email'])) ? 'is-invalid' : 'is-valid' ?>" placeholder="Enter email" value="<?= isset($data['user']->email) ?  $data['user']->email : ''?>">
    </div>
    <?php if (isset($data['errors']['email'])) : ?>
        <div class="mb-3">
            <small class="text-danger">
                <?= $data['errors']['email'] ?>
            </small>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <input type="password" name="password" class="form-control <?= (isset($data['errors']['password'])) ? 'is-invalid' : 'is-valid' ?>" placeholder="Enter Password" >
    </div>
    <?php if (isset($data['errors']['password'])) : ?>
        <div class="mb-3">
            <small class="text-danger">
                <?= $data['errors']['password'] ?>
            </small>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Log In</button>
    </div>
    <div class="d-flex justify-content-center m-2">
        <a href="/register" ><small>Create new account?</small></a>
    </div>
</form>
</div>

<?php require __DIR__ . '/includes/Footer.php' ?>
