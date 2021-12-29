<?php

namespace App\Models;

use Core\App;

class UserModel extends Model
{

    protected array $errors = [];
    protected array $data = [];
    public string $username;
    public string $email;
    public string $password;
    public string $password_confirm;
    protected $db;
    protected $pdo;


    public function __construct($username, $email, $password, $password_confirm)
    {
        $this->db = App::get('database');
        $this->pdo = $this->db->pdo;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->password_confirm = $password_confirm;
    }

    public function getAll()
    {
        return App::get('database')->pdo->query("SELECT * FROM user")->fetchAll();
    }

    public function insert()
    {
        $this->data = [
            'username' => $this->username,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'api_key' => implode('-', str_split(substr(strtolower(md5(microtime() . rand(1000, 9999))), 0, 30), 6)),
            'role' => 'user'
        ];

        $this->db->insert('user', $this->data);
    }

    public function validate(): array
    {
        if (empty($this->username) || strlen($this->username) < 2){
            $this->errors['username'] = 'Username is required and must be at least 2 characters long';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is not valid';
        }
        if (empty($this->password) || strlen($this->password) < 8){
            $this->errors['password'] = 'Password is required and must be at least 8 characters long';
        }
        if ($this->password_confirm != $this->password) {
            $this->errors['password_confirm'] = 'Password confirm have to match with password';
        }

        return $this->errors;
    }
}