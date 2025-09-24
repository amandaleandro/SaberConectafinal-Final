<?php
require_once __DIR__ . '/../models/Conteudo.php';
require_once __DIR__ . '/../models/Materia.php';

class ConteudoController extends Controller
{
    /**
     * Formulário para criar ou editar conteúdo
     */
    public function form()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $materiaModel = new Materia();
        $materias = $materiaModel->listarPorProfessor($professorId);

        $conteudo = null;
        if (isset($_GET['id'])) {
            $conteudoModel = new Conteudo();
            $conteudo = $conteudoModel->buscarPorId($_GET['id']);
        }

        return $this->view("conteudo/form", compact("materias", "conteudo"));
    }

    /**
     * Salvar conteúdo (criar ou atualizar)
     */
    public function salvar()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $dados = [
                'id'               => $_POST['id'] ?? null,
                'titulo'           => $_POST['titulo'] ?? '',
                'descricao'        => $_POST['descricao'] ?? '',
                'tipo'             => $_POST['tipo'] ?? 'pdf',
                'nivel_dificuldade'=> $_POST['nivel_dificuldade'] ?? 'medio',
                'url_externa'      => $_POST['url_externa'] ?? '',
                'materia_id'       => $_POST['materia_id'] ?? null,
                'professor_id'     => $professorId,
                'caminho_arquivo'  => null
            ];

            // Upload de arquivo
            if (!empty($_FILES['caminho_arquivo']['name'])) {
                $uploadDir = "public/uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $arquivoNome = time() . "_" . basename($_FILES['caminho_arquivo']['name']);
                $destino = $uploadDir . $arquivoNome;

                if (move_uploaded_file($_FILES['caminho_arquivo']['tmp_name'], $destino)) {
                    $dados['caminho_arquivo'] = $destino;
                }
            }

            $conteudoModel = new Conteudo();
            $conteudoModel->salvar($dados);

            header("Location: ?route=conteudo/meusProfessor&msg=sucesso");
            exit;
        }
    }

    /**
     * Lista conteúdos do professor
     */
    public function meusProfessor()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarPorProfessor($professorId);

        return $this->view("conteudo/meus_professor", compact("conteudos"));
    }

    /**
     * Lista conteúdos do aluno
     */
    public function meusAluno()
    {
        $alunoId = $_SESSION['usuario_id'] ?? null;
        if (!$alunoId || $_SESSION['usuario_tipo'] !== 'aluno') {
            header("Location: ?route=auth/login");
            exit;
        }

        $conteudoModel = new Conteudo();
        $conteudos = $conteudoModel->listarPorAluno($alunoId);

        return $this->view("conteudo/meus_aluno", compact("conteudos"));
    }

    /**
     * Excluir conteúdo
     */
    public function excluir()
    {
        $professorId = $_SESSION['usuario_id'] ?? null;
        if (!$professorId || $_SESSION['usuario_tipo'] !== 'professor') {
            header("Location: ?route=auth/login");
            exit;
        }

        if (isset($_GET['id'])) {
            $conteudoModel = new Conteudo();
            $conteudoModel->excluir($_GET['id'], $professorId);
        }
        header("Location: ?route=conteudo/meusProfessor&msg=excluido");
        exit;
    }

    /**
     * Visualizar conteúdo (aluno e professor podem abrir)
     */
    public function visualizar()
    {
        if (!isset($_GET['id'])) {
            header("Location: ?route=conteudo/meusAluno");
            exit;
        }

        $conteudoModel = new Conteudo();
        $conteudo = $conteudoModel->buscarPorId($_GET['id']);

        return $this->view("conteudo/visualizar", compact("conteudo"));
    }
}
