<?php

namespace App\Controllers;

use Core\Session;

class Controller
{
    public Session $session;

    public function __construct()
    {
        Session::start();
    }

    public function renderView($view, $data = [])
    {
        if (file_exists(ROOT_APP . "/views/$view.php"))
        {
            require_once ROOT_APP . "/views/includes/Header.php";

            require_once ROOT_APP . "/views/$view.php";

            require_once ROOT_APP . "/views/includes/Footer.php";
        }else
            echo "404 | Page not found";
    }

    public function redirect($view)
    {
        header('Location: ' . ROOT_URL . "/$view");

    }

    public function refresh()
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}