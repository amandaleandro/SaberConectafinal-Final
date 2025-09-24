<?php
require_once __DIR__ . "/../core/Database.php";

class Conteudo {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function salvar($dados){
      if (!empty($dados['id'])) {
        // Atualizar
        return $this->atualizar(
            $dados['id'],
            $dados['titulo'],
            $dados['descricao'],
            $dados['tipo'],
            $dados['nivel_dificuldade'],
            $dados['url_externa'],
            $dados['caminho_arquivo'] ?? null,
            $dados['professor_id'],
            $dados['materia_id']
      );
      } else {
        // Cadastrar novo
        return $this->cadastrar(
            $dados['titulo'],
            $dados['descricao'],
            $dados['tipo'],
            $dados['nivel_dificuldade'],
            $dados['url_externa'],
            $dados['caminho_arquivo'] ?? null,
            $dados['professor_id'],
            $dados['materia_id']
        );
      }
    }
    // CRUD
    public function cadastrar($titulo, $descricao, $tipo, $nivel, $url, $arquivo, $professorId, $materiaId) {
        $sql = "INSERT INTO conteudos (titulo, descricao, tipo, nivel_dificuldade, url_externa, caminho_arquivo, professor_id, materia_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$titulo, $descricao, $tipo, $nivel, $url, $arquivo, $professorId, $materiaId]);
    }

    public function atualizar($id, $titulo, $descricao, $tipo, $nivel, $url, $arquivo, $professorId, $materiaId) {
        $sql = "UPDATE conteudos SET titulo=?, descricao=?, tipo=?, nivel_dificuldade=?, url_externa=?, caminho_arquivo=?, professor_id=?, materia_id=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$titulo, $descricao, $tipo, $nivel, $url, $arquivo, $professorId, $materiaId, $id]);
    }

    public function excluir($id) {
        $stmt = $this->db->prepare("DELETE FROM conteudos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM conteudos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listagens
    public function listarTodos() {
        $stmt = $this->db->query("SELECT * FROM conteudos ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarPorProfessor($professorId) {
      $sql = "SELECT c.*, m.nome AS materia_nome
            FROM conteudos c
            INNER JOIN materias m ON c.materia_id = m.id
            WHERE c.professor_id = ?
            ORDER BY c.created_at DESC";
      $stmt = $this->db->prepare($sql);
      $stmt->execute([$professorId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarPorAluno($alunoId) {
    $sql = "SELECT c.*,
                   IF(EXISTS(
                        SELECT 1 
                        FROM favoritos f 
                        WHERE f.usuario_id = ? 
                          AND f.conteudo_id = c.id
                   ), 1, 0) AS favorito
            FROM conteudos c
            INNER JOIN conteudos_aluno ca ON c.id = ca.conteudo_id
            WHERE ca.usuario_id = ?
            ORDER BY c.created_at DESC";
      $stmt = $this->db->prepare($sql);
      $stmt->execute([$alunoId, $alunoId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

    public function listarSugeridos($alunoId) {
        $sql = "SELECT c.* FROM conteudos c
                WHERE c.id NOT IN (SELECT conteudo_id FROM conteudos_aluno WHERE usuario_id = ?)
                ORDER BY RAND() LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$alunoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarFavoritosPorAluno($alunoId) {
        $sql = "SELECT c.* FROM conteudos c
                INNER JOIN favoritos f ON c.id = f.conteudo_id
                WHERE f.usuario_id = ?
                ORDER BY f.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$alunoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vincular / Desvincular
    public function vincularAluno($alunoId, $conteudoId) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO conteudos_aluno (usuario_id, conteudo_id) VALUES (?, ?)");
        return $stmt->execute([$alunoId, $conteudoId]);
    }

    public function desvincularAluno($alunoId, $conteudoId) {
        $stmt = $this->db->prepare("DELETE FROM conteudos_aluno WHERE usuario_id = ? AND conteudo_id = ?");
        return $stmt->execute([$alunoId, $conteudoId]);
    }
    public function contarPorTipo($professorId, $tipo) {
        $sql = "SELECT COUNT(*) as total 
            FROM conteudos 
            WHERE professor_id = ? AND tipo = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute([$professorId, $tipo]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row['total'] ?? 0;
    }

    // Favoritar
    public function favoritarAluno($alunoId, $conteudoId) {
        $stmt = $this->db->prepare("INSERT IGNORE INTO favoritos (usuario_id, conteudo_id) VALUES (?, ?)");
        return $stmt->execute([$alunoId, $conteudoId]);
    }

    public function desfavoritarAluno($alunoId, $conteudoId) {
        $stmt = $this->db->prepare("DELETE FROM favoritos WHERE usuario_id = ? AND conteudo_id = ?");
        return $stmt->execute([$alunoId, $conteudoId]);
    }

    // Estatísticas
    public function contarPorProfessor($professorId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM conteudos WHERE professor_id = ?");
        $stmt->execute([$professorId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function contarPorAluno($alunoId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM conteudos_aluno WHERE usuario_id = ?");
        $stmt->execute([$alunoId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
    public function contarFavoritosPorAluno($alunoId) {
      $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM favoritos WHERE usuario_id = ?");
      $stmt->execute([$alunoId]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row['total'] ?? 0;
    }

    public function contarAcessosPorAluno($alunoId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM acessos WHERE usuario_id = ?");
        $stmt->execute([$alunoId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    public function contarAcessosPorProfessor($professorId) {
        $sql = "SELECT COUNT(*) as total 
                FROM acessos a
                INNER JOIN conteudos c ON c.id = a.conteudo_id
                WHERE c.professor_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$professorId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
