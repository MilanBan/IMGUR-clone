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

    public function find(array $parameter)
    {
        var_dump('usao u find GM');

        $sql = sprintf("SELECT * FROM `gallery` WHERE `%s` = '%s'",
            $parameter[0],
            $parameter[1]
        );
           $x = $this->pdo->query($sql)->fetch();
        return  $x;
    }

    public function update($id)
    {
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'hidden' => $this->hidden,
            'nsfw' => $this->nsfw
        ];

        $params = [];

        foreach ($data as $k => $v) {
            $params[] = "$k = :$k";
        }

        $sql = sprintf("UPDATE `gallery` SET %s WHERE id = %s",
            implode(', ', $params),
            ':id'
        );
        $data['id'] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            return true;
        }catch (\PDOException $e){
            return  false;
        }

    }
}