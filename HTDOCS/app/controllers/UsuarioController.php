<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Conteudo.php';
require_once __DIR__ . '/../models/Materia.php';

class UsuarioController extends Controller
{
    public function perfil()
    {
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        if (!$usuarioId) {
            header("Location: ?route=auth/login");
            exit;
        }

        // MODELOS QUE VAMOS USAR
        $conteudoModel = new Conteudo();
        $usuarioModel  = new Usuario();

        // Monta estatísticas dinâmicas conforme o tipo
        $estatisticas = [];

        if (($_SESSION['usuario_tipo'] ?? '') === 'aluno') {
            $estatisticas = [
                'acessos'     => (int) $conteudoModel->contarAcessosPorAluno($usuarioId),
                'disciplinas' => (int) $usuarioModel->contarMateriasAluno($usuarioId), // <-- ajustado
                'favoritos'   => (int) $conteudoModel->contarFavoritosPorAluno($usuarioId),
                'tempo_estudo'=> null, // placeholder
            ];
        } else { // professor
            $estatisticas = [
                'publicados'     => (int) $conteudoModel->contarPorProfessor($usuarioId),
                'alunos'         => (int) $usuarioModel->contarAlunosPorProfessor($usuarioId),
                'visualizacoes'  => (int) $conteudoModel->contarAcessosPorProfessor($usuarioId)
            ];
        }

        // pega dados do usuário
        $usuario = $usuarioModel->buscarPorId($usuarioId);

        return $this->view("auth/perfil", [
            "usuario"      => $usuario,
            "mensagem"     => $_SESSION['mensagem'] ?? null,
            "erro"         => $_SESSION['erro'] ?? null,
            "estatisticas" => $estatisticas,
        ]);
    }

    public function atualizarPerfil()
    {
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        if (!$usuarioId) {
            header("Location: ?route=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if (strlen($nome) < 3) {
                $_SESSION['erro'] = "O nome deve ter pelo menos 3 caracteres.";
                header("Location: ?route=usuario/perfil");
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['erro'] = "Por favor, insira um email válido.";
                header("Location: ?route=usuario/perfil");
                exit;
            }

            $usuarioModel = new Usuario();
            $usuarioExistente = $usuarioModel->buscarPorEmail($email);

            if ($usuarioExistente && $usuarioExistente['id'] != $usuarioId) {
                $_SESSION['erro'] = "Este email já está sendo usado por outro usuário.";
                header("Location: ?route=usuario/perfil");
                exit;
            }

            // Montar dados
            $dados = [
                'nome'  => $nome,
                'email' => $email,
            ];

            if ($_SESSION['usuario_tipo'] === 'aluno') {
                $dados['nivel_escolar'] = $_POST['nivel_escolar'] ?? null;
            } else {
                $dados['especializacao'] = trim($_POST['especializacao'] ?? '');
                $dados['instituicao']    = trim($_POST['instituicao'] ?? '');
                $dados['bio']            = trim($_POST['bio'] ?? '');
            }

            $ok = $usuarioModel->atualizarPerfil($usuarioId, $dados);

            if ($ok) {
                $_SESSION['usuario_nome'] = $nome;
                $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
            } else {
                $_SESSION['erro'] = "Erro ao atualizar perfil.";
            }
        }

        header("Location: ?route=usuario/perfil");
        exit;
    }

    public function alterarSenha()
    {
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        if (!$usuarioId) {
            header("Location: ?route=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $senhaAtual   = $_POST['senha_atual'] ?? '';
            $novaSenha    = $_POST['nova_senha'] ?? '';
            $confirmar    = $_POST['confirmar_senha'] ?? '';
            $usuarioModel = new Usuario();
            $usuario      = $usuarioModel->buscarPorId($usuarioId);

            if (!password_verify($senhaAtual, $usuario['senha'])) {
                $_SESSION['erro'] = "Senha atual incorreta!";
            } elseif ($novaSenha !== $confirmar) {
                $_SESSION['erro'] = "As senhas não coincidem!";
            } elseif (strlen($novaSenha) < 8) {
                $_SESSION['erro'] = "A nova senha deve ter pelo menos 8 caracteres!";
            } else {
                $ok = $usuarioModel->alterarSenha($usuarioId, password_hash($novaSenha, PASSWORD_DEFAULT));
                if ($ok) {
                    $_SESSION['mensagem'] = "Senha alterada com sucesso!";
                } else {
                    $_SESSION['erro'] = "Erro ao alterar senha.";
                }
            }

            header("Location: ?route=usuario/perfil");
            exit;
        } else {
            $_SESSION['erro'] = "Acesse essa funcionalidade pelo formulário de alteração de senha.";
            header("Location: ?route=usuario/perfil");
            exit;
        }
    }

    public function excluirConta()
    {
        $usuarioId = $_SESSION['usuario_id'] ?? null;
        if (!$usuarioId) {
            header("Location: ?route=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioModel = new Usuario();
            $ok = $usuarioModel->excluirConta($usuarioId);

            if ($ok) {
                session_destroy();
                header("Location: ?route=auth/login&msg=contaExcluida");
                exit;
            } else {
                $_SESSION['erro'] = "Erro ao excluir conta.";
                header("Location: ?route=usuario/perfil");
                exit;
            }
        } else {
            $_SESSION['erro'] = "A exclusão de conta deve ser feita pelo formulário.";
            header("Location: ?route=usuario/perfil");
            exit;
        }
    }
}
