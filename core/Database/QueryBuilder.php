<?php

namespace Core\Database;

use PDOException;

class QueryBuilder
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(string $table, array $parameters)
    {
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function find(string $table, array $parameters)
    {
        $sql = sprintf("SELECT * FROM `%s` WHERE `%s` = '%s'",
            $table,
            $parameters[0],
            $parameters[1],
        );
        return $this->pdo->query($sql)->fetch();
    }

    public function get(array $parameters, string $table, int $limit, int $offset)
    {
        $sql = sprintf("SELECT `%s` FROM `%s` LIMIT %s OFFSET %s",
            implode("`, `", $parameters),
            $table,
            $limit,
            $offset
        );
        return $this->pdo->query($sql)->fetchAll();
    }

    public function delete(string $table, string $column, $id)
    {
        $sql = sprintf("DELETE FROM %s WHERE %s = %s",
            $table,
            $column,
            $id
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return true;
        }catch (PDOException $e){
            return false;
        }
    }



}