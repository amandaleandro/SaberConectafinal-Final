<?php
require_once __DIR__ . '/../core/Database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // ===================
    // AUTENTICAÇÃO
    // ===================
    public function login($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }

    public function criar($nome, $email, $senha, $tipo, $nivel = null) {
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo, nivel_escolar, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $nome,
            $email,
            password_hash($senha, PASSWORD_DEFAULT),
            $tipo,
            $nivel
        ]);
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // ===================
    // PERFIL
    // ===================
    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    public function atualizarPerfil($usuarioId, $dados)
    {
        if (empty($dados) || !$usuarioId) {
            return false;
        }
        $campos = [];
        $valores = [];

        foreach ($dados as $campo => $valor) {
            $campos[] = "$campo = ?";
            $valores[] = $valor;
        }

        $valores[] = $usuarioId; // id vai no final

        $sql = "UPDATE usuarios SET " . implode(", ", $campos) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($valores);
    }

    public function alterarSenha($id, $senhaHash) {
        $sql = "UPDATE usuarios SET senha=?, updated_at=NOW() WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$senhaHash, $id]);
    }

    public function excluirConta($usuarioId)
    {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$usuarioId]);
    }

    // ===================
    // DASHBOARD STATS
    // ===================
    public function contarMateriasAluno($alunoId) {
        $sql = "SELECT COUNT(*) as total FROM materias_aluno WHERE usuario_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$alunoId]);
        $row = $stmt->fetch();
        return $row ? (int)$row['total'] : 0;
    }

    public function contarAlunosPorProfessor($professorId) {
        $sql = "SELECT COUNT(DISTINCT ma.usuario_id) as total
                FROM materias_aluno ma
                INNER JOIN materias m ON m.id = ma.materia_id
                WHERE m.professor_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$professorId]);
        $row = $stmt->fetch();
        return $row ? (int)$row['total'] : 0;
    }

    // ===================
    // PROFESSOR: ALUNOS
    // ===================
    public function listarAlunosPorProfessor($professorId) {
        $sql = "SELECT DISTINCT u.*
                FROM usuarios u
                INNER JOIN materias_aluno ma ON u.id = ma.usuario_id
                INNER JOIN materias m ON m.id = ma.materia_id
                WHERE m.professor_id = ? AND u.tipo = 'aluno'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$professorId]);
        return $stmt->fetchAll();
    }

    public function desvincularAluno($alunoId, $professorId) {
        $sql = "DELETE ma FROM materias_aluno ma
                INNER JOIN materias m ON m.id = ma.materia_id
                WHERE ma.usuario_id = ? AND m.professor_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$alunoId, $professorId]);
    }
}
