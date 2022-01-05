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

        if (Session::get('user')){
            $sql = "SELECT `file_name`, `slug` FROM `image` WHERE `user_id` =  $id ORDER BY `id` DESC limit 10 offset 0";

            return $this->pdo->query($sql)->fetchAll();
        }
    }

    public function getAllFromGallery($id)
    {
        $user_Id = $this->pdo->query("SELECT `user_id` FROM `gallery` WHERE `id` = $id")->fetchColumn();
        if (Session::get('user')->id == $user_Id) {
            $sql = "SELECT i.`file_name`, i.`slug` FROM `image` i INNER JOIN `image_gallery` ig ON i.`id` = ig.`image_id` WHERE ig.`gallery_id` =  $id ORDER BY i.`id` DESC limit 10 offset 0";
        }elseif (Session::get('user') && Session::get('user')->id !== $user_Id)
        {
            $sql = "SELECT i.`file_name`, i.`slug` FROM `image` i INNER JOIN `image_gallery` ig ON i.`id` = ig.`image_id` WHERE ig.`gallery_id` = $id AND i.`hidden` = 0 ORDER BY i.`id` DESC LIMIT 10 OFFSET 0";
        }
            return $this->pdo->query($sql)->fetchAll();
    }

    public function findFromUser(array $parameter)
    {
        $sql = sprintf("SELECT * FROM `image` WHERE `%s` = '%s' AND `user_id` = %s",
            $parameter[0],
            $parameter[1],
            Session::get('user')->id
        );

        return $this->pdo->query($sql)->fetch();
    }

    public function findImage(array $parameter)
    {
        $sql = sprintf("SELECT * FROM `image` WHERE `%s` = '%s'",
            $parameter[0],
            $parameter[1],
        );

        return $this->pdo->query($sql)->fetch();
    }

    public function insert($gallery_id)
    {
        $data = [
            'user_id' => $this->user_id,
            'file_name' => $this->file_name,
            'slug' => $this->slug
        ];

        $image_id = $this->db->insert('image', $data);
        $this->db->insert('image_gallery', ['image_id' => $image_id, 'gallery_id' => $gallery_id]);
    }
}