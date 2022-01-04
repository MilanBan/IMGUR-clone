<?php


use Core\Session;


?>
<?= Session::get('user')->id ?>
<div class="container">
    <?php if (isset($data['user'])) : ?>
    <div class="d-flex flex-wrap justify-content-center">
        <h1><strong><?= $data['user']->username; ?></strong>'s profile page</h1>
    </div>
    <div class="container my-5 min-content-height">
         <div class="d-flex justify-content-md-center">
             <a class="btn btn-sm btn-primary" type="button" href="/galleries/create">Add Gallery</a>
         </div>
    </div>
    <?php endif; ?>
  <div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-center">
        <?php if (isset($data['galleries'])) : ?>
            <table class="table table-hover table-bordered w-70">
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
