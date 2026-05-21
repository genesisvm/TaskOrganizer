<?php
require_once __DIR__ . '/../config/Database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getByUsuario($usuario_id) {
        $query = "Select * From tareas Where usuario_id = :usuario_id Order By created_at Desc";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['usuario_id' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($usuario_id, $titulo, $descripcion) {
        $query = "Insert Into tareas (usuario_id, titulo, descripcion, estado) Values (:usuario_id, :titulo, :descripcion, 'Pendiente')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'usuario_id' => $usuario_id,
            'titulo' => $titulo,
            'descripcion' => $descripcion
        ]);
    }

    public function updateStatus($id, $usuario_id, $estado) {
        $query = "Update tareas Set estado = :estado Where id = :id And usuario_id = :usuario_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'estado' => $estado,
            'id' => $id,
            'usuario_id' => $usuario_id
        ]);
    }
}