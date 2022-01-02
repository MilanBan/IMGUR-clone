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
        var_dump('usao u getAll GM');
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

    public function findFromUser(array $parameter)
    {
        var_dump('usao u find GM');

        $sql = sprintf("SELECT * FROM `gallery` WHERE `%s` = '%s' AND `user_id` = %s",
            $parameter[0],
            $parameter[1],
            Session::get('user')->id
        );

        return $this->pdo->query($sql)->fetch();
    }
}