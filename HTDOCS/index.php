<?php
// =============================================
// SABER CONECTA - SISTEMA EDUCACIONAL
// =============================================
require_once __DIR__ . "/config.php";

// =============================================
// Handlers de Erro / Exceção
// =============================================

set_error_handler(function($severity, $message, $file, $line) {
    logError("PHP Error: {$message}", ['severity' => $severity, 'file' => $file, 'line' => $line]);
    
    if (ENVIRONMENT === 'development') {
        http_response_code(500);
        echo "<h1>Erro de PHP</h1>";
        echo "<pre>";
        echo "Severidade: {$severity}\n";
        echo "Mensagem: {$message}\n";
        echo "Arquivo: {$file}\n";
        echo "Linha: {$line}\n";
        echo "</pre>";
        exit;
    } else {
        header('Location: ?route=error/500');
        exit;
    }
});

set_exception_handler(function($exception) {
    logError("Uncaught Exception: " . $exception->getMessage(), [
        'type' => get_class($exception), 
        'file' => $exception->getFile(), 
        'line' => $exception->getLine()
    ]);
    
    if (ENVIRONMENT === 'development') {
        http_response_code(500);
        echo "<h1>Exceção não tratada</h1>";
        echo "<pre>";
        echo "Tipo: " . get_class($exception) . "\n";
        echo "Mensagem: " . $exception->getMessage() . "\n";
        echo "Arquivo: " . $exception->getFile() . "\n";
        echo "Linha: " . $exception->getLine() . "\n\n";
        echo $exception->getTraceAsString();
        echo "</pre>";
        exit;
    } else {
        header('Location: ?route=error/500');
        exit;
    }
});

// =============================================
// Carregar classes core e execução principal
// =============================================
try {
    // Carregar classes core
    require_once __DIR__ . "/app/core/Router.php";
    require_once __DIR__ . "/app/core/Controller.php";
    require_once __DIR__ . "/app/core/Database.php";

    $router = new Router();
    $route = $_GET['route'] ?? "site/home";

    if (!preg_match('/^[a-zA-Z0-9_\/]+$/', $route)) {
        throw new InvalidArgumentException("Rota inválida fornecida");
    }

    $router->dispatch($route);

} catch (Exception $e) {
    logError("Application Error: " . $e->getMessage(), [
        'file' => $e->getFile(), 
        'line' => $e->getLine()
    ]);
    
    if (ENVIRONMENT === 'development') {
        http_response_code(500);
        echo "<h1>Erro interno</h1>";
        echo "<pre>";
        echo "Mensagem: " . $e->getMessage() . "\n";
        echo "Arquivo: " . $e->getFile() . "\n";
        echo "Linha: " . $e->getLine() . "\n\n";
        echo $e->getTraceAsString();
        echo "</pre>";
        exit;
    } else {
        header('Location: ?route=error/500');
        exit;
    }
}