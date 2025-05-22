<?php

namespace App\Model;

class DatabaseConnexion
{
    public ?\PDO $database = null;

    public function getConnexion(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=grizzlyvision;charset=utf8', 'root', '');
        }

        return $this->database;
    }
}
