<?php

namespace App\Models;

use Core\App;
use Core\Session;

class ImageModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    // Guest
    public function getAll()
    {
       $sql = "SELECT i.`file_name`, i.`slug`, u.`username` FROM `image` i INNER JOIN `user` u ON i.`user_id` = u.`id` WHERE i.`nsfw` = 0 AND i.`hidden` = 0 ORDER BY i.`id` desc LIMIT 10 OFFSET 1";
       return $this->pdo->query($sql)->fetchAll();
    }

    public function guest_find(array $parameter)
    {
        $sql = sprintf("SELECT i.`file_name`, i.`slug`, u.`username` FROM `image` i INNER JOIN `user` u ON i.`user_id` = u.`id` WHERE i.`nsfw` = 0 AND i.`hidden` = 0 AND i.`%s` = '%s'",
            $parameter[0],
            $parameter[1]
        );
        return $this->pdo->query($sql)->fetch();
    }
    // Auth User
    public function getAllFromUser($id)
    {
        var_dump('usao u IM get all id='.$id);
        Session::start();

        if (Session::get('user')){
            $sql = "SELECT i.`file_name`, i.`slug`, u.`username` FROM `image` i left JOIN `user` u ON i.`user_id` = u.`id` WHERE u.`id` =  $id limit 10 offset 0";

            return $this->pdo->query($sql)->fetchAll();
        }
    }

    public function findFromUser(array $parameter)
    {
        var_dump('usao u IM find u image model : ');
        $sql = sprintf("SELECT * FROM `image` WHERE `%s` = '%s' AND `user_id` = %s",
            $parameter[0],
            $parameter[1],
            Session::get('user')->id
        );
        var_dump($sql);
        return $this->pdo->query($sql)->fetch();
    }
}