<?php
class ErrorController extends Controller
{
    public function notFound($context = [])
    {
        http_response_code(404);
        return $this->view("errors/404", [
            "titulo"   => "Página Não Encontrada",
            "mensagem" => "A página que você está procurando não existe ou foi removida.",
            "contexto" => $context
        ]);
    }

    public function forbidden($context = [])
    {
        http_response_code(403);
        return $this->view("errors/generic", [
            "codigo"   => 403,
            "titulo"   => "Acesso Negado",
            "mensagem" => "Você não tem permissão para acessar esta página.",
            "contexto" => $context
        ]);
    }

    public function methodNotAllowed($context = [])
    {
        http_response_code(405);
        return $this->view("errors/generic", [
            "codigo"   => 405,
            "titulo"   => "Método Não Permitido",
            "mensagem" => "O método HTTP utilizado não é permitido para esta rota.",
            "contexto" => $context
        ]);
    }

    public function internalError($context = [])
    {
        http_response_code(500);
        return $this->view("errors/generic", [
            "codigo"   => 500,
            "titulo"   => "Erro Interno do Servidor",
            "mensagem" => "Ocorreu um erro inesperado no sistema.",
            "contexto" => $context
        ]);
    }

    public function maintenance($context = [])
    {
        http_response_code(503);
        return $this->view("errors/generic", [
            "codigo"   => 503,
            "titulo"   => "Manutenção",
            "mensagem" => "O sistema está temporariamente indisponível para manutenção. Tente novamente em alguns instantes.",
            "contexto" => $context
        ]);
    }

    public function custom($code = 500, $title = "Erro", $message = "Ocorreu um erro.", $details = "", $context = [])
    {
        http_response_code($code);
        return $this->view("errors/generic", [
            "codigo"   => $code,
            "titulo"   => $title,
            "mensagem" => $message,
            "detalhes" => $details,
            "contexto" => $context
        ]);
    }

    public function database($error)
    {
        http_response_code(500);
        return $this->view("errors/generic", [
            "codigo"   => 500,
            "titulo"   => "Erro no Banco de Dados",
            "mensagem" => "Houve um problema ao acessar o banco de dados.",
            "detalhes" => $error['message'] ?? "Erro desconhecido"
        ]);
    }
}
