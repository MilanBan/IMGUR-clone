<?php

namespace App\Models;

use Core\Session;

class GalleryModel extends Model
{
    protected array $errors = [];
    protected array $data;

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
            $sql = "SELECT `id`, `name`, `slug` FROM `gallery` WHERE `user_id` = $id ORDER BY `id` DESC LIMIT 8 OFFSET 0";
        }elseif (Session::get('user') && Session::get('user')->id !== $id)
        {
            $sql = "SELECT `id`, `name`, `slug` FROM `gallery` WHERE `hidden` = 0 AND `nsfw` = 0 ORDER BY `id` DESC LIMIT 8 OFFSET 0";
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

    public function delete($id)
    {
        $this->db->delete('image_gallery', 'gallery_id', $id);
        $this->db->delete('gallery', 'id', $id);
    }

    public function validate(): array
    {
        $this->errors = [];
        $this->validateName();
        $this->validateDescription();

        return $this->errors;
    }

    private function validateName()
    {
        if (empty($this->name)){
            $this->errors['name'] = 'Name is required';
        }
        if(strlen($this->name) < 2){
            $this->errors['name'] =  'Name must contain at least 2 characters';
        }
        if ($this->pdo->query("SELECT `name` FROM `gallery` WHERE `name` = '$this->name'")->rowCount()){
            $this->errors['name'] = 'A Gallery with this name already exists';
        }
    }

    private function validateDescription()
    {
        if (empty($this->description)){
            $this->errors['description'] = 'Description is required';
        }
        if(strlen($this->description) < 2){
            $this->errors['description'] =  'Description must contain at least 2 characters';
        }
    }

    public function insert()
    {
        $this->data = [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'hidden' => $this->hidden,
            'nsfw' => $this->nsfw
        ];

        return $this->db->insert('gallery', $this->data);
    }

}
