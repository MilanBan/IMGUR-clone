<?php require __DIR__ . '/includes/Header.php'?>

<div class="container">
<?php foreach ($data as $user) : ?>
    <h5><?php echo $user->username ?></h5>
<?php endforeach; ?>
</div>

<?php require __DIR__ . '/includes/Footer.php'?>
