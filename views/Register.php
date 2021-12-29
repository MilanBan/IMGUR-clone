<?php require __DIR__ . '/includes/Header.php'?>
<div class="d-flex justify-content-center mt-5 ">
<form action="/register" method="post">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Enter Username">
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Enter email">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Enter Password">
    </div>
    <div class="form-group">
        <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password">
    </div>
    <button type="submit" class="btn btn-primary">Sign In</button>
</form>
</div>
<?php require __DIR__ . '/includes/Footer.php' ?>
