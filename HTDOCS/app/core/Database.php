<?php
require_once __DIR__ . '/../../config.php';

class Database {
    private static $instance = null;
    private $conn;

    private $driver;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;

    private function __construct() {
        $this->driver  = defined('DB_DRIVER') ? DB_DRIVER : 'mysql';
        $this->host    = DB_HOST;
        $this->db      = DB_NAME;
        $this->user    = DB_USER;
        $this->pass    = DB_PASS;
        $this->charset = defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4';

        try {
            $dsn = "{$this->driver}:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $this->conn = new PDO(
                $dsn,
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch(PDOException $e) {
            $this->handleConnectionError($e);
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    private function handleConnectionError($exception) {
        $errorData = [
            'title'      => 'Erro de Conexão',
            'message'    => 'Não foi possível conectar ao banco de dados.',
            'suggestion' => 'Verifique se o servidor e credenciais estão corretos.',
            'server'     => $this->host,
            'database'   => $this->db,
            'technical'  => $exception->getMessage()
        ];

        error_log("DB Error: " . $exception->getMessage());

        if (defined('DEBUG') && DEBUG) {
            $errorData['debug'] = [
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
                'file'    => $exception->getFile(),
                'line'    => $exception->getLine()
            ];
        }

        http_response_code(500);
        if (defined('DEBUG') && DEBUG) {
            echo "<pre>"; print_r($errorData); echo "</pre>";
        } else {
            echo "<h2>Erro interno no servidor</h2><p>Tente novamente mais tarde.</p>";
        }
        exit;
    }

    public function testConnection() {
        return $this->conn !== null;
    }

    public function getConnectionInfo() {
        if ($this->conn) {
            return [
                'status'      => 'connected',
                'driver'      => $this->driver,
                'host'        => $this->host,
                'database'    => $this->db,
                'server_info' => $this->conn->getAttribute(PDO::ATTR_SERVER_INFO),
                'client_ver'  => $this->conn->getAttribute(PDO::ATTR_CLIENT_VERSION)
            ];
        }
        return ['status' => 'disconnected'];
    }
}
