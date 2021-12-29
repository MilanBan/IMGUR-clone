<?php

namespace App\Models;

use Core\App;

abstract class Model
{
    protected $pdo;
    protected $db;

    public function __construct()
    {
        $this->db = App::get('database');
        $this->pdo = $this->db->pdo;
    }

}