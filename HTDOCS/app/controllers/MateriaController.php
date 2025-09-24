<?php
require_once __DIR__ . '/../models/Materia.php';

class MateriaController extends Controller
{
    // Formulário (novo ou editar)
    public function form()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $materia = null;
        if (isset($_GET['id'])) {
            $materiaModel = new Materia();
            $materia = $materiaModel->buscarPorId($_GET['id']);
        }

        return $this->view("materia/form", compact("materia"));
    }

    // Salvar (novo ou atualização)
    public function salvar()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id          = $_POST['id'] ?? null;
            $nome        = $_POST['nome'] ?? '';
            $descricao   = $_POST['descricao'] ?? '';
            $nivelEnsino = $_POST['nivel_ensino'] ?? 'fundamental';

            $materiaModel = new Materia();

            if ($id) {
                // Atualizar
                if ($materiaModel->atualizar($id, $nome, $descricao, $nivelEnsino, $professorId)) {
                    header("Location: ?route=materia/minhas&msg=atualizado");
                    exit;
                }
            } else {
                // Cadastrar
                if ($materiaModel->cadastrar($nome, $descricao, $nivelEnsino, $professorId)) {
                    header("Location: ?route=materia/minhas&msg=sucesso");
                    exit;
                }
            }

            $erro = "Erro ao salvar matéria.";
            return $this->view("materia/form", compact("erro"));
        }
    }

    // Minhas matérias
    public function minhas()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $materiaModel = new Materia();
        $materias = $materiaModel->listarPorProfessor($professorId);

        return $this->view("materia/minhas", compact("materias"));
    }

    // Excluir
    public function excluir()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        if (isset($_GET['id'])) {
            $materiaModel = new Materia();
            $materiaModel->excluir($_GET['id'], $professorId);
        }

        header("Location: ?route=materia/minhas&msg=excluido");
        exit;
    }
}
