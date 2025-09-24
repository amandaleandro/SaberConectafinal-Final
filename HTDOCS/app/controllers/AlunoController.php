<?php
require_once __DIR__ . '/../models/Materia.php';
require_once __DIR__ . '/../models/Conteudo.php';

class AlunoController extends Controller
{
    // ======================
    // DASHBOARD
    // ======================
    public function dashboard(){
        
        $alunoId = $_SESSION['usuario_id'] ?? null;
        if (!$alunoId || $_SESSION['usuario_tipo'] !== 'aluno') {
            header("Location: ?route=auth/login");
            exit;
        }

        $materiaModel  = new Materia();
        $conteudoModel = new Conteudo();

        $materias           = $materiaModel->listarPorAluno($alunoId);
        $conteudos          = $conteudoModel->listarPorAluno($alunoId);
        $sugeridosConteudos = $conteudoModel->listarSugeridos($alunoId); // 👈 NOVO

        return $this->view("aluno/dashboard", compact("materias", "conteudos", "sugeridosConteudos"));
    }

    // ======================
    // MATÉRIAS
    // ======================
    public function todasMaterias()
    {
        $materiaModel = new Materia();
        $materias = $materiaModel->listarTodas();
        return $this->view("aluno/todas_materias", compact("materias"));
    }

    public function minhasMaterias()
    {
        $alunoId = $_SESSION['usuario_id'];
        $materiaModel = new Materia();
        $materias = $materiaModel->listarPorAluno($alunoId);
        return $this->view("aluno/minhas_materias", compact("materias"));
    }

    public function sugeridasMaterias()
    {
        $alunoId = $_SESSION['usuario_id'];
        $materiaModel = new Materia();
        $materias = $materiaModel->listarSugeridas($alunoId);
        return $this->view("aluno/sugeridas_materias", compact("materias"));
    }

    public function favoritasMaterias()
    {
        $alunoId = $_SESSION['usuario_id'];
        $materiaModel = new Materia();
        $materias = $materiaModel->listarFavoritasPorAluno($alunoId);
        return $this->view("aluno/favoritas_materias", compact("materias"));
    }

    public function vincularMateria()
    {
        $alunoId   = $_SESSION['usuario_id'];
        $materiaId = $_GET['id'] ?? null;

        if ($materiaId) {
            $materiaModel = new Materia();
            $materiaModel->vincularAluno($alunoId, $materiaId);
        }
        header("Location: ?route=aluno/minhasMaterias");
        exit;
    }

    public function desvincularMateria()
    {
        $alunoId   = $_SESSION['usuario_id'];
        $materiaId = $_GET['id'] ?? null;

        if ($materiaId) {
            $materiaModel = new Materia();
            $materiaModel->desvincularAluno($alunoId, $materiaId);
        }
        header("Location: ?route=aluno/minhasMaterias");
        exit;
    }

    public function favoritarMateria()
    {
        $alunoId   = $_SESSION['usuario_id'];
        $materiaId = $_GET['id'] ?? null;

        if ($materiaId) {
            $materiaModel = new Materia();
            $materiaModel->favoritarAluno($alunoId, $materiaId);
        }
        header("Location: ?route=aluno/favoritasMaterias");
        exit;
    }

    public function desfavoritarMateria()
    {
        $alunoId   = $_SESSION['usuario_id'];
        $materiaId = $_GET['id'] ?? null;

        if ($materiaId) {
            $materiaModel = new Materia();
            $materiaModel->desfavoritarAluno($alunoId, $materiaId);
        }
        header("Location: ?route=aluno/favoritasMaterias");
        exit;
    }

    // ======================
    // CONTEÚDOS
    // ======================
    public function todosConteudos()
    {
        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarTodos();
        return $this->view("aluno/todos_conteudos", compact("conteudos"));
    }

    public function meusConteudos()
    {
        $alunoId = $_SESSION['usuario_id'];
        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarPorAluno($alunoId);
        return $this->view("aluno/meus_conteudos", compact("conteudos"));
    }

    public function sugeridosConteudos()
    {
        $alunoId = $_SESSION['usuario_id'];
        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarSugeridos($alunoId);
        return $this->view("aluno/sugeridos_conteudos", compact("conteudos"));
    }

    public function favoritosConteudos()
    {
        $alunoId = $_SESSION['usuario_id'];
        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarFavoritosPorAluno($alunoId);
        return $this->view("aluno/favoritos_conteudos", compact("conteudos"));
    }

    public function vincularConteudo()
    {
        $alunoId    = $_SESSION['usuario_id'];
        $conteudoId = $_GET['id'] ?? null;

        if ($conteudoId) {
            $conteudoModel = new Conteudo();
            $conteudoModel->vincularAluno($alunoId, $conteudoId);
        }
        header("Location: ?route=aluno/meusConteudos");
        exit;
    }

    public function desvincularConteudo()
    {
        $alunoId    = $_SESSION['usuario_id'];
        $conteudoId = $_GET['id'] ?? null;

        if ($conteudoId) {
            $conteudoModel = new Conteudo();
            $conteudoModel->desvincularAluno($alunoId, $conteudoId);
        }
        header("Location: ?route=aluno/meusConteudos");
        exit;
    }

    public function favoritarConteudo()
    {
        $alunoId    = $_SESSION['usuario_id'];
        $conteudoId = $_GET['id'] ?? null;

        if ($conteudoId) {
            $conteudoModel = new Conteudo();
            $conteudoModel->favoritarAluno($alunoId, $conteudoId);
        }
        header("Location: ?route=aluno/favoritosConteudos");
        exit;
    }

    public function desfavoritarConteudo()
    {
        $alunoId    = $_SESSION['usuario_id'];
        $conteudoId = $_GET['id'] ?? null;

        if ($conteudoId) {
            $conteudoModel = new Conteudo();
            $conteudoModel->desfavoritarAluno($alunoId, $conteudoId);
        }
        header("Location: ?route=aluno/favoritosConteudos");
        exit;
    }

    // ======================
    // VISUALIZAÇÃO
    // ======================
    public function visualizarConteudo()
    {
        $conteudoId = $_GET['id'] ?? null;
        if (!$conteudoId) {
            header("Location: ?route=aluno/meusConteudos");
            exit;
        }

        $conteudoModel = new Conteudo();
        $conteudo = $conteudoModel->buscarPorId($conteudoId);

        return $this->view("aluno/visualizar_conteudo", compact("conteudo"));
    }

    public function visualizarMateria()
    {
        $materiaId = $_GET['id'] ?? null;
        if (!$materiaId) {
            header("Location: ?route=aluno/minhasMaterias");
            exit;
        }

        $materiaModel = new Materia();
        $materia = $materiaModel->buscarPorId($materiaId);

        return $this->view("aluno/visualizar_materia", compact("materia"));
    }
}
