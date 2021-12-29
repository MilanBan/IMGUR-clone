<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends Controller
{

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
                $user = new UserModel($data['username'], $data['email'], $data['password'], $data['password_confirm']);
                $errors = $user->validate();

                if (count($errors)) {
                    http_response_code(422);
                    $this->renderView('Register', ['errors' => $errors, 'user' => $user]);
                }else{
                    $user->insert();
                    http_response_code(201);
                    $this->renderView('Home', $data);
                }
            }
        }

    }
}