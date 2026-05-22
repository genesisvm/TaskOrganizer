<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // login
    public function showLogin() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // Registro
    public function showRegister() {
        require_once __DIR__ . '/../views/auth/registro.php';
    }

    // Inicio de sesión
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $userModel = new User();
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombre'] = $user['nombre'];
                header("Location: /taskorganizer/mvc_nativo/public/index.php");
                exit();
            } else {
                $_SESSION['error'] = "Credenciales incorrectas.";
                header("Location: /taskorganizer/mvc_nativo/public/index.php?action=login");
                exit();
            }
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (!empty($nombre) && !empty($email) && !empty($password)) {
                $userModel = new User();
                $userModel->register($nombre, $email, $password);
                header("Location: /taskorganizer/mvc_nativo/public/index.php?action=login");
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /taskorganizer/mvc_nativo/public/index.php?action=login");
        exit();
    }
}