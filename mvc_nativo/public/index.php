<?php
require_once __DIR__ . '/../controllers/TaskController.php';
require_once __DIR__ . '/../controllers/AuthController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$authController = new AuthController();

// Rutas públicas
if ($action === 'login') {
    $authController->showLogin();
    exit();
} elseif ($action === 'register') {
    $authController->showRegister();
    exit();
} elseif ($action === 'doLogin') {
    $authController->login();
    exit();
} elseif ($action === 'doRegister') {
    $authController->register();
    exit();
} elseif ($action === 'logout') {
    $authController->logout();
    exit();
}

// Filtro de las rutas privadas
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /mvc_nativo/public/index.php?action=login");
    exit();
}

// Rutas privadas de las tareas
$taskController = new TaskController();
if ($action === 'store') {
    $taskController->store();
} elseif ($action === 'updateAjax') {
    $taskController->updateStatusAjax();
} else {
    $taskController->index();
}