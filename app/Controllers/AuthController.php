<?php

namespace App\Controllers;

use App\Helper;
use App\Models\UserModel;
use Core\Session;

class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $this->renderView('Home');
    }

    public function register()
    {
        if (strtolower($_SERVER["REQUEST_METHOD"]) === "get") {
            $this->renderView('Register');
        }

        if (strtolower($_SERVER["REQUEST_METHOD"]) === "post") {
            if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "username" => trim($_POST["username"]),
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                    "password_confirm" => trim($_POST["password_confirm"]),
                ];
                $userM = new UserModel($data['username'], $data['email'], $data['password'], $data['password_confirm']);
                $errors = $userM->validate('register');

                if (count($errors)) {
                    http_response_code(422);
                    $this->renderView('Register', ['errors' => $errors, 'user' => $userM]);
                }else{
                    $user = $userM->insert();
                    Session::set('user', $user);
                    http_response_code(201);
                    Session::set('username', Helper::encode($user->username));
                    $this->redirect('profile/'.Session::get('username'));
                }
            }
        }
    }

    public function login()
    {
        if (strtolower($_SERVER["REQUEST_METHOD"]) === "get") {
            $this->renderView('Login');
        }

        if (strtolower($_SERVER["REQUEST_METHOD"]) === "post") {
            if (isset($_POST['email']) && isset($_POST['password'])){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                ];
                $userM = new UserModel('', $data['email'], $data['password'], '');
                $errors = $userM->validate('login');
                if (count($errors)) {
                    http_response_code(422);
                    $this->renderView('Login', ['errors' => $errors, 'user' => $userM]);
                }else{
                    $user = $userM->find('user', ['email', $userM->email]);
                    Session::set('user', $user);
                    Session::set('username', Helper::encode($user->username));
                    http_response_code(200);
                    $this->redirect('profile/'. Session::get('username'));
                }
            }
        }
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect('');
    }
}