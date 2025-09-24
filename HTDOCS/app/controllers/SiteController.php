<?php
class SiteController extends Controller {
    public function home() {
        return $this->view("site/home");
    }

    public function sobre() {
        return $this->view("site/sobre");
    }
    
    public function seed() {
        $db = Database::getInstance()->getConnection();

        // Limpa tabelas (ordem importante por causa das FKs)
        $db->exec("SET FOREIGN_KEY_CHECKS=0");
        $db->exec("TRUNCATE TABLE acessos");
        $db->exec("TRUNCATE TABLE favoritos");
        $db->exec("TRUNCATE TABLE conteudos");
        $db->exec("TRUNCATE TABLE materias_aluno");
        $db->exec("TRUNCATE TABLE materias");
        $db->exec("TRUNCATE TABLE usuarios");
        $db->exec("SET FOREIGN_KEY_CHECKS=1");

        // Senhas de exemplo
        $alunoSenha = password_hash("12345678", PASSWORD_DEFAULT);
        $profSenha  = password_hash("12345678", PASSWORD_DEFAULT);

        // Usuários
        $stmt = $db->prepare("INSERT INTO usuarios (nome,email,senha,tipo,nivel_escolar) VALUES (?,?,?,?,?)");
        $stmt->execute(["Aluno Exemplo","aluno@saber.com",$alunoSenha,"aluno","9º ano"]);
        $stmt->execute(["Professor Exemplo","prof@saber.com",$profSenha,"professor",null]);

        $prof_id  = $db->lastInsertId();
        $aluno_id = 1;

        // Matérias
        $stmtMateria = $db->prepare("INSERT INTO materias (nome,descricao,nivel_ensino,professor_id) VALUES (?,?,?,?)");
        $stmtMateria->execute(["História","Disciplina de História do 9º ano","9º ano",$prof_id]);
        $historia_id = $db->lastInsertId();

        $stmtMateria->execute(["Matemática","Disciplina de Matemática do 9º ano","9º ano",$prof_id]);
        $matematica_id = $db->lastInsertId();

        // Relacionar aluno às matérias
        $db->exec("INSERT INTO materias_aluno (usuario_id,materia_id) VALUES ($aluno_id,$historia_id),($aluno_id,$matematica_id)");

        // Conteúdos
        $stmtConteudo = $db->prepare("INSERT INTO conteudos (titulo,descricao,tipo,nivel_dificuldade,url_externa,professor_id,materia_id) VALUES (?,?,?,?,?,?,?)");
        $stmtConteudo->execute(["Revolução Francesa","Resumo histórico","video","medio","https://youtu.be/teste",$prof_id,$historia_id]);
        $stmtConteudo->execute(["Equações 2º Grau","Lista de exercícios","pdf","medio","https://example.com/pdf",$prof_id,$matematica_id]);

        echo "<h3>Seed concluído ✅</h3>
        <p><strong>Aluno:</strong> aluno@saber.com / 12345678</p>
        <p><strong>Professor:</strong> prof@saber.com / 12345678</p>";
    }
}
?>
