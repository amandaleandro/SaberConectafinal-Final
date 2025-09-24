<?php
require_once __DIR__ . "/../core/Database.php";

class Acesso {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function registrar($uid, $mid) {
        $sql = "INSERT INTO acessos (usuario_id, material_id, data_acesso) 
                VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$uid, $mid]);
    }

    public function ultimosPorUsuario($uid, $limit = 5) {
        $sql = "SELECT a.*, m.titulo, m.disciplina, a.data_acesso
                FROM acessos a
                JOIN materiais m ON a.material_id = m.id
                WHERE a.usuario_id = ?
                ORDER BY a.data_acesso DESC
                LIMIT $limit"; // cuidado: compatibilidade cross-db

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $uid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function contarPorUsuario($uid) {
        return $this->contarPorColuna("usuario_id", $uid);
    }

    public function contarPorMaterial($mid) {
        return $this->contarPorColuna("material_id", $mid);
    }

    private function contarPorColuna($coluna, $valor) {
        $sql = "SELECT COUNT(*) as total FROM acessos WHERE {$coluna} = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$valor]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($result['total'] ?? 0);
    }
}
