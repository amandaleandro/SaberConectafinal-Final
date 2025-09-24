<?php
require_once __DIR__ . "/../core/Database.php";

class Materia {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // CRUD básico
    public function cadastrar($nome, $descricao, $nivelEnsino, $professorId) {
        $sql = "INSERT INTO materias (nome, descricao, nivel_ensino, professor_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $descricao, $nivelEnsino, $professorId]);
    }

    public function atualizar($id, $nome, $descricao, $nivelEnsino, $professorId) {
        $sql = "UPDATE materias SET nome=?, descricao=?, nivel_ensino=? WHERE id=? AND professor_id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $descricao, $nivelEnsino, $id, $professorId]);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM materias WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM materias WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listagens
    public function listarTodas() {
        $stmt = $this->db->query("SELECT * FROM materias ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorProfessor($professorId) {
        $stmt = $this->db->prepare("SELECT * FROM materias WHERE professor_id = ? ORDER BY created_at DESC");
        $stmt->execute([$professorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarPorAluno($alunoId) {
        $sql = "SELECT m.*,
                   IF(EXISTS(
                        SELECT 1 
                        FROM materias_favoritas mf 
                        WHERE mf.usuario_id = ? 
                          AND mf.materia_id = m.id
                   ), 1, 0) AS favorita
            FROM materias m
            INNER JOIN materias_aluno ma ON m.id = ma.materia_id
            WHERE ma.usuario_id = ?
            ORDER BY m.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$alunoId, $alunoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function listarFavoritasPorAluno($alunoId) {
        $sql = "SELECT m.* FROM materias m
                INNER JOIN materias_favoritas mf ON m.id = mf.materia_id
                WHERE mf.usuario_id = ?
                ORDER BY mf.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$alunoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarSugeridas($alunoId) {
            $sql = "SELECT m.* FROM materias m
                WHERE m.id NOT IN (
                SELECT materia_id FROM materias_aluno WHERE usuario_id = ?
                UNION
                SELECT materia_id FROM materias_favoritas WHERE usuario_id = ?
            )
            ORDER BY RAND() LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$alunoId, $alunoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vincular / Desvincular
    public function vincularAluno($alunoId, $materiaId) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO materias_aluno (usuario_id, materia_id) VALUES (?, ?)");
        return $stmt->execute([$alunoId, $materiaId]);
    }

    public function desvincularAluno($alunoId, $materiaId) {
        $stmt = $this->db->prepare("DELETE FROM materias_aluno WHERE usuario_id = ? AND materia_id = ?");
        return $stmt->execute([$alunoId, $materiaId]);
    }

    // Favoritar
    public function favoritarAluno($alunoId, $materiaId) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO materias_favoritas (usuario_id, materia_id) VALUES (?, ?)");
        return $stmt->execute([$alunoId, $materiaId]);
    }

    public function desfavoritarAluno($alunoId, $materiaId) {
        $stmt = $this->db->prepare("DELETE FROM materias_favoritas WHERE usuario_id = ? AND materia_id = ?");
        return $stmt->execute([$alunoId, $materiaId]);
    }

    // Estatísticas
    public function contarPorProfessor($professorId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM materias WHERE professor_id = ?");
        $stmt->execute([$professorId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function contarPorAluno($alunoId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM materias_aluno WHERE usuario_id = ?");
        $stmt->execute([$alunoId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
