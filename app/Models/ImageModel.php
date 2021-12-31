<?php

namespace App\Models;

use Core\App;
use Core\Session;

class ImageModel extends Model
{

    public function __construct()
    {
        $this->db = App::get('database');
        $this->pdo = $this->db->pdo;
    }
    // Guest
    public function guest_getAll()
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
    public function getAll($id)
    {
        Session::start();

        if (Session::get('user')){
            $sql = "SELECT i.`file_name`, i.`slug`, u.`username` FROM `image` i Left JOIN `user` u ON i.`user_id` = u.`id` WHERE u.`id` = 1 
                    UNION
                    SELECT i.`file_name`, i.`slug`, u.`username` FROM `image` i left JOIN `user` u ON i.`user_id` = u.`id` WHERE i.`hidden` = 0 
                    limit 10 offset 1";

            return $this->pdo->query($sql)->fetchAll();
        }
    }
}