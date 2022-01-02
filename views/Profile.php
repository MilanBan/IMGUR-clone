<?php


use Core\Session;

require __DIR__ . '/includes/Header.php'

?>

<div class="container">
    <h1>THIS IS USER PROFILE PAGE</h1>
    <?php if (isset($data['user'])) : ?>
        <h1>User: <?= $data['user']->username; ?></h1>
        <h1>Email: <?= $data['user']->email; ?></h1>
    <?php endif; ?>
  <div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-start">
        <?php if (isset($data['galleries'])) : ?>
            <table class="table table-hover table-bordered w-50">
                <thead>
                <tr>
                    <th scope="col">
                        Gallery name
                    </th>
                </tr>
                </thead>
                <tbody>
        <?php foreach ($data['galleries'] as $gallery) : ?>
                <tr>
                    <th scope="row">
                        <a class="mx-auto" href="http://localhost:8080/galleries/<?= $gallery->slug ?> ">
                            <?= $gallery->name ?>
                        </a>
                    </th>
                </tr>
        <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
  </div>
</div>
<?php require __DIR__ . '/includes/Footer.php'?>
