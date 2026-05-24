<?php
require_once __DIR__ . '/../models/Task.php';

class TaskController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
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
            header("Location: index.php");
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

    public function edit() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $taskModel = new Task();
            $tarea = $taskModel->getById($id, $_SESSION['usuario_id']);
            if ($tarea) {
                require_once __DIR__ . '/../views/tasks/edit.php';
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            header("Location: index.php");
            exit();
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);
            
            if (!empty($titulo)) {
                $taskModel = new Task();
                $taskModel->update($id, $_SESSION['usuario_id'], $titulo, $descripcion);
            }
        }
        header("Location: index.php");
        exit();
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $taskModel = new Task();
            $taskModel->delete($id, $_SESSION['usuario_id']);
        }
        header("Location: index.php");
        exit();
    }
}