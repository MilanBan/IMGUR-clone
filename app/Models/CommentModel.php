<?php

namespace App\Models;

class CommentModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($table, $id)
    {
        if ($table == 'gallery'){
            return $this->pdo->query("SELECT comment.`comment`, user.`username`, comment.`id` FROM `comment` INNER JOIN `user` ON comment.`user_id` = user.`id` WHERE comment.`gallery_id` = '$id' ORDER BY comment.`id` DESC")->fetchAll();
        }
        if ($table == 'image'){
            return $this->pdo->query("SELECT comment.`comment`, user.`username`, comment.`id` FROM `comment` INNER JOIN `user` ON comment.`user_id` = user.`id` WHERE comment.`image_id` = '$id' ORDER BY comment.`id` DESC")->fetchAll();
        }
    }
}