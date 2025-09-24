<?php
require_once __DIR__ . "/../models/Usuario.php";

class AuthController extends Controller
{
    /**
     * Tela de login + processamento
     */
    public function login()
    {
        $erro = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            $usuarioModel = new Usuario();
            $dados = $usuarioModel->login($email, $senha);

            if ($dados) {
                // cria sessão
                $_SESSION['usuario_id']   = $dados['id'];
                $_SESSION['usuario_nome'] = $dados['nome'];
                $_SESSION['usuario_tipo'] = $dados['tipo'];

                // Redireciona para dashboard conforme tipo
                if ($dados['tipo'] === 'aluno') {
                    header("Location: ?route=aluno/dashboard");
                } else {
                    header("Location: ?route=professor/dashboard");
                }
                exit;
            } else {
                $erro = "Email ou senha inválidos.";
            }
        }

        return $this->view("auth/login", compact('erro'));
    }

    /**
     * Tela de cadastro + processamento
     */
    public function cadastro()
    {
        $erro = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome          = trim($_POST['nome'] ?? '');
            $email         = trim($_POST['email'] ?? '');
            $senha         = trim($_POST['senha'] ?? '');
            $tipo          = $_POST['tipo'] ?? '';
            $nivel_escolar = $_POST['nivel_escolar'] ?? null;

            $usuarioModel = new Usuario();

            // Evita cadastro duplicado
            if ($usuarioModel->buscarPorEmail($email)) {
                $erro = "Este e-mail já está cadastrado.";
            } else {
                $ok = $usuarioModel->criar($nome, $email, $senha, $tipo, $nivel_escolar);
                if ($ok) {
                    header("Location: ?route=auth/login&msg=cadastro_sucesso");
                    exit;
                } else {
                    $erro = "Erro ao cadastrar usuário. Tente novamente.";
                }
            }
        }

        return $this->view("auth/cadastro", compact('erro'));
    }

    /**
     * Logout do sistema
     */
    public function logout()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        session_start();
        session_regenerate_id(true);

        header("Location: ?route=site/home&msg=logout_success");
        exit;
    }
}
