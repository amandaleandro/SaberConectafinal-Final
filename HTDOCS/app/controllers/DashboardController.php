<?php
require_once __DIR__ . '/../models/Conteudo.php';
require_once __DIR__ . '/../models/Materia.php';
require_once __DIR__ . '/../models/Usuario.php';

class DashboardController extends Controller
{
    // DASHBOARD DO ALUNO
    public function aluno()
    {
        $alunoId = $_SESSION['usuario_id'] ?? null;
        if (!$alunoId || $_SESSION['usuario_tipo'] !== 'aluno') {
            header("Location: ?route=auth/login");
            exit;
        }

        $conteudoModel = new Conteudo();
        $materiaModel  = new Materia();

        // Estatísticas do aluno
        $totalMaterias   = $materiaModel->contarPorAluno($alunoId);
        $materias        = $materiaModel->listarPorAluno($alunoId);

        // Proteção: só chama se o método existir
        $totalFavoritos  = method_exists($conteudoModel, 'contarFavoritosPorAluno') 
            ? $conteudoModel->contarFavoritosPorAluno($alunoId) 
            : 0;

        $totalAcessos    = method_exists($conteudoModel, 'contarAcessosPorAluno') 
            ? $conteudoModel->contarAcessosPorAluno($alunoId) 
            : 0;

        $totalConteudos  = $conteudoModel->contarPorAluno($alunoId);

        return $this->view("aluno/dashboard", [
            "totalMaterias"  => $totalMaterias,
            "materias"       => $materias,
            "totalFavoritos" => $totalFavoritos,
            "totalAcessos"   => $totalAcessos,
            "totalConteudos" => $totalConteudos
        ]);
    }

    // DASHBOARD DO PROFESSOR
    /*public function professor()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $conteudoModel = new Conteudo();
        $materiaModel  = new Materia();
        $usuarioModel  = new Usuario();

        $totalMaterias   = $materiaModel->contarPorProfessor($professorId);
        $totalConteudos  = $conteudoModel->contarPorProfessor($professorId);
        $totalAlunos     = $usuarioModel->contarAlunosPorProfessor($professorId);

        $totalAcessos    = method_exists($conteudoModel, 'contarAcessosPorProfessor') 
            ? $conteudoModel->contarAcessosPorProfessor($professorId) 
            : 0;

        $materias        = $materiaModel->listarPorProfessor($professorId);
        $conteudos       = $conteudoModel->listarPorProfessor($professorId);

        return $this->view("professor/dashboard", [
            "totalMaterias"  => $totalMaterias,
            "totalConteudos" => $totalConteudos,
            "totalAlunos"    => $totalAlunos,
            "totalAcessos"   => $totalAcessos,
            "materias"       => $materias,
            "conteudos"      => $conteudos
        ]);
    }*/
        public function professor()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $conteudoModel = new Conteudo();
        $materiaModel  = new Materia();
        $usuarioModel  = new Usuario();

        // Estatísticas principais
        $totalMaterias   = $materiaModel->contarPorProfessor($professorId);
        $totalConteudos  = $conteudoModel->contarPorProfessor($professorId);
        $totalAlunos     = $usuarioModel->contarAlunosPorProfessor($professorId);
        $totalAcessos    = $conteudoModel->contarAcessosPorProfessor($professorId);

        $materias        = $materiaModel->listarPorProfessor($professorId);
        $conteudos       = $conteudoModel->listarPorProfessor($professorId);

        // Estatísticas por tipo de conteúdo
        $conteudosTipos = [
            "PDF"      => $conteudoModel->contarPorTipo($professorId, "pdf"),
            "Vídeo"    => $conteudoModel->contarPorTipo($professorId, "video"),
            "Link"     => $conteudoModel->contarPorTipo($professorId, "link"),
            "Outro"    => $conteudoModel->contarPorTipo($professorId, "outro"),
        ];

        return $this->view("professor/dashboard", [
            "totalMaterias"   => $totalMaterias,
            "totalConteudos"  => $totalConteudos,
            "totalAlunos"     => $totalAlunos,
            "totalAcessos"    => $totalAcessos,
            "materias"        => $materias,
            "conteudos"       => $conteudos,
            "conteudosTipos"  => $conteudosTipos
        ]);
    }
}
