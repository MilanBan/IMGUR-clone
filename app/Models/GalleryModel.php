<?php

namespace App\Models;

use Core\Session;

class GalleryModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllFromUser($id)
    {
        $sql = '';
        if (Session::get('user')->id == $id)
        {
            $sql = "SELECT `name`, `slug` FROM `gallery` WHERE `user_id` = $id LIMIT 8 OFFSET 0";
        }elseif (Session::get('user') && Session::get('user')->id !== $id)
        {
            $sql = "SELECT `name`, `slug` FROM `gallery` WHERE `user_id` = $id AND `hidden` = 0 LIMIT 8 OFFSET 0";
        }
        return $this->pdo->query($sql)->fetchAll();

    }
}