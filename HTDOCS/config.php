<?php
// =============================================
// AMBIENTES E CONFIGURAÇÕES DE ERRO
// =============================================

// Detecta o ambiente de execução
if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'infinityfree.me') !== false) {
    // Produção - InfinityFree
    define('ENVIRONMENT', 'production');
} else {
    // Produção - Outros servidores (configuração padrão para produção)
    define('ENVIRONMENT', 'production');
}

// Configurações de Debug e Erro
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    define('DEBUG', true);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    define('DEBUG', false);
}

// =============================================
// CONFIGURAÇÕES DO SABERCONECTA MVC
// =============================================

// Configurações de Banco de Dados
if (ENVIRONMENT === 'production') {
    define('DB_HOST', 'sql307.infinityfree.com');
    define('DB_NAME', 'if0_39957673_saberconecta');
    define('DB_USER', 'if0_39957673');
    define('DB_PASS', 'devweb2025');
} else {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'saberconecta');
    define('DB_USER', 'root');
    define('DB_PASS', '');
}

// Configurações da Aplicação
define('APP_NAME', 'Saber Conecta');
define('APP_URL', 'https://saberconecta.infinityfreeapp.com');
define('APP_VERSION', '1.0.0');

// Configurações de Upload
define('UPLOAD_PATH', 'public/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png']);

// Configurações de Segurança
define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_MIN_LENGTH', 6);
define('LOGIN_MAX_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 300); // 5 minutos

// Configurações de Sessão
define('SESSION_NAME', 'saberconecta_session');
define('SESSION_LIFETIME', 3600); // 1 hora
define('SESSION_SECURE', true); // HTTPS habilitado para produção
define('SESSION_HTTPONLY', true);

// Inicia sessão
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_set_cookie_params([
        'lifetime' => SESSION_LIFETIME,
        'path' => '/',
        'domain' => '',
        'secure' => SESSION_SECURE,
        'httponly' => SESSION_HTTPONLY
    ]);
    ini_set('session.cookie_lifetime', SESSION_LIFETIME);
    ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
    session_start();
}

// Timezone
date_default_timezone_set('America/Sao_Paulo');

// =============================================
// FUNÇÕES HELPER
// =============================================

function debug($data, $die = false) {
    if (defined('DEBUG') && DEBUG) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if ($die) {
            die();
        }
    }
}

function logError($message, $context = []) {
    $logMessage = date('Y-m-d H:i:s') . ' - ' . $message;
    if (!empty($context)) {
        $logMessage .= ' - Context: ' . json_encode($context);
    }
    error_log($logMessage);
}

function generateCSRFToken() {
    if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

function verifyCSRFToken($token) {
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function isAjaxRequest() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>