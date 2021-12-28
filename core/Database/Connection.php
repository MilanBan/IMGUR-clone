<?php

namespace Core\Database;

use PDO;
use PDOException;

class Connection
{
    public static function connect($config)
    {
        try {
            return new PDO($config['host'] . ';dbname=' . $config['name'], $config['username'], $config['password'], $config['options']);
        } catch (PDOException $e) {
            http_response_code(500);
            die($e->getMessage());
        }
    }
}