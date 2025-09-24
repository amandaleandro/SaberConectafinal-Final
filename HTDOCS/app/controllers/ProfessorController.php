<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Materia.php';
require_once __DIR__ . '/../models/Conteudo.php';

class ProfessorController extends Controller
{
    // ===========================
    // DASHBOARD
    // ===========================
    public function dashboard()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $usuarioModel  = new Usuario();
        $materiaModel  = new Materia();
        $conteudoModel = new Conteudo();

        $totalMaterias  = $materiaModel->contarPorProfessor($professorId);
        $totalAlunos    = $usuarioModel->contarAlunosPorProfessor($professorId);
        $totalConteudos = $conteudoModel->contarPorProfessor($professorId);

        return $this->view("professor/dashboard", [
            "totalMaterias"  => $totalMaterias,
            "totalAlunos"    => $totalAlunos,
            "totalConteudos" => $totalConteudos
        ]);
    }

    // ===========================
    // GERENCIAR ALUNOS
    // ===========================
    public function gerenciarAlunos()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $usuarioModel = new Usuario();
        $alunos = $usuarioModel->listarAlunosPorProfessor($professorId);

        return $this->view("professor/alunos", [
            "alunos" => $alunos,
            "mensagem" => $_SESSION['mensagem'] ?? null,
            "erro" => $_SESSION['erro'] ?? null
        ]);
    }

    public function desvincularAluno()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alunoId = $_POST['aluno_id'] ?? null;

            if ($alunoId) {
                $usuarioModel = new Usuario();
                $ok = $usuarioModel->desvincularAluno($alunoId, $professorId);

                if ($ok) {
                    $_SESSION['mensagem'] = "Aluno desvinculado com sucesso!";
                } else {
                    $_SESSION['erro'] = "Erro ao desvincular aluno.";
                }
            }
        }

        header("Location: ?route=professor/gerenciarAlunos");
        exit;
    }

    // ===========================
    // PERFIL DO PROFESSOR
    // ===========================
    public function editarPerfil()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->buscarPorId($professorId);

        return $this->view("professor/perfil", [
            "usuario"  => $usuario,
            "mensagem" => $_SESSION['mensagem'] ?? null,
            "erro"     => $_SESSION['erro'] ?? null
        ]);
    }

    public function salvarPerfil()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? null);

            $usuarioModel = new Usuario();

            // Atualizar perfil
            $ok = $usuarioModel->atualizarPerfil($professorId, $nome, $email, null);

            // Atualizar senha se informada
            if (!empty($senha)) {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                $usuarioModel->alterarSenha($professorId, $senhaHash);
            }

            if ($ok) {
                $_SESSION['usuario_nome'] = $nome;
                $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
            } else {
                $_SESSION['erro'] = "Erro ao atualizar perfil.";
            }
        }

        header("Location: ?route=professor/editarPerfil");
        exit;
    }
}
