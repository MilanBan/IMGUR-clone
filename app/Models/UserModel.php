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
    protected string $mode;


    public function __construct($username = null, $email, $password, $password_confirm = null)
    {
        $this->db = App::get('database');
        $this->pdo = $this->db->pdo;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->password_confirm = $password_confirm;
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

        $userID = $this->db->insert('user', $this->data);

        return $this->find('user', ['id', $userID]);
    }

    public function find(string $table, array $parameter)
    {

        return $this->db->find($table, $parameter);
    }


    public function validate($mode = []): array
    {
        $this->errors = [];
        $this->mode = $mode;

        $this->validateEmail();
        $this->validatePassword();

        if ($mode === 'register') {
            $this->validateUsername();
            $this->validateEmailExist();
            $this->validatePasswordMatching();
        }
        if ($mode === 'login') {
            $this->validateUserExist();
        }

        return $this->errors;
    }

    private function validateUsername()
    {
        if (empty($this->username)){
            $this->errors['username'] = 'Username is required';
        }
        if(strlen($this->username) < 2){
            $this->errors['username'] =  'Username must contain at least 2 characters';
        }
        if ($this->pdo->query("SELECT `username` FROM `user` WHERE `username` = '$this->username'")->rowCount()){
            $this->errors['username'] = 'A user with this Username already exists';
        }
    }

    private function validateEmail()
    {
        if (empty($this->email)){
            $this->errors['email'] = 'Email is required';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is not valid';
        }
    }

    private function validateEmailExist()
    {
        if ($this->pdo->query("SELECT `email` FROM `user` WHERE `email` = '$this->email'")->rowCount()) {
            $this->errors['email'] = "User with $this->email email address is already registered";
        }
    }

    private function validateUserExist()
    {
        if ($this->pdo->query("SELECT `email`,`password` FROM `user` WHERE `email` = '$this->email' AND `password` = '$this->password'")->fetch()) {
            $this->errors['user'] = "User with $this->email email and $this->username does not exists";
        }
    }

    private function validatePassword()
    {
        if (empty($this->password)){
            $this->errors['password'] = 'Password is required';
        }
        if(strlen($this->password) < 8){
            $this->errors['password'] = 'Password must be at least 8 characters long';
        }
    }

    private function validatePasswordMatching()
    {
        if (empty($this->password_confirm)){
            $this->errors['password_confirm'] = 'Password confirming is required';
        }
        if ($this->password_confirm !== $this->password){
            $this->errors['password_confirm'] = 'Password did not match. Please try again.';
        }
    }

}