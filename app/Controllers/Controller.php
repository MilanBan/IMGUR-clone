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
            require_once ROOT_APP . "/views/$view.php";
        else
            echo "404 | Page not found";
    }
}