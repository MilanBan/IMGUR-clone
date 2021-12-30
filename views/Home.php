<?php require __DIR__ . '/includes/Header.php'?>

<div class="container">
<h1>THIS IS HOME PAGE</h1>
    <?php if (isset($data['user'])) : ?>
        <h4> Welcome <?= $data['user']->username; ?> </h4>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/Footer.php'?>
