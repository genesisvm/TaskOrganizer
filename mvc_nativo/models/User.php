<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function register($nombre, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "Insert Into usuarios (nombre, email, password) Values (:nombre, :email, :password)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'nombre' => $nombre,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }

    public function login($email, $password) {
        $query = "Select * From usuarios Where email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}