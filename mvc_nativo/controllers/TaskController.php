<?php
require_once __DIR__ . '/../models/Task.php';

class TaskController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Simulación de sesión para desarrollo rápido (reemplazar con Auth real si es necesario)
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['usuario_id'] = 1; 
            $_SESSION['usuario_nombre'] = "Usuario de Pruebas";
        }
    }

    public function index() {
        $taskModel = new Task();
        $tareas = $taskModel->getByUsuario($_SESSION['usuario_id']);
        require_once __DIR__ . '/../views/tasks/index.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            
            if (!empty($titulo)) {
                $taskModel = new Task();
                $taskModel->create($_SESSION['usuario_id'], $titulo, $descripcion);
            }
            header("Location: /mvc_nativo/public/index.php");
            exit();
        }
    }

    public function updateStatusAjax() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id']);
            $estado = $_POST['estado'];
            
            $taskModel = new Task();
            $success = $taskModel->updateStatus($id, $_SESSION['usuario_id'], $estado);
            
            echo json_encode(['success' => $success]);
            exit();
        }
    }
}