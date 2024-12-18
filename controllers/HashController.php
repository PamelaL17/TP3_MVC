<?php
namespace App\Controllers;

class HashController {
    public function generate() {
        $password = 'test1234'; // Le mot de passe pour acceder au reste du site web
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        echo "Mot de passe haché : " . $hashedPassword;
    }
}