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

    function registerUser($lastname, $firstname, $phone, $postal_code, $city, $email, $password)
    {
        $stmt = $this->connexion->getConnexion()->prepare(
            'INSERT INTO users (lastname, firstname, phone, postal_code, city, email, password) 
             VALUES (:lastname, :firstname, :phone, :postal_code, :city, :email, :password)'
        );
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }

    function searchUser($email)
    {
        // Peut etre va falloir enlever l'etoiles à un moment parceque ça pourrait renvoyer tte les données, même les mots de passe
        $stmt = $this->connexion->getConnexion()->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
