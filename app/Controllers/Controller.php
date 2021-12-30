<?php

namespace App\Controllers;

class Controller
{
    public function renderView($view, $data = [])
    {
        if (file_exists(ROOT_APP . "/views/$view.php"))
            require_once ROOT_APP . "/views/$view.php";
        else
            echo "404 | Page not found";
    }
}