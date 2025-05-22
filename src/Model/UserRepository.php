<?php

namespace App\Model;

use App\Model\DatabaseConnexion;

class UserRepository
{

    private DatabaseConnexion $connexion;

    public function __construct()
    {
        $this->connexion = new DatabaseConnexion();
    }

    function registerUser($username, $phone, $email, $password)
    {
        $stmt = $this->connexion->getConnexion()->prepare(
            'INSERT INTO user (username, phone, email, password) 
             VALUES (:username, :phone, :email, :password)'
        );
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }

    function searchUser($email)
    {
        // Peut etre va falloir enlever l'etoiles à un moment parceque ça pourrait renvoyer tte les données, même les mots de passe
        $stmt = $this->connexion->getConnexion()->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result; 
    }
}
