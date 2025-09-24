<?php
require_once __DIR__ . '/Database.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Executa uma query simples com parâmetros
     */
    protected function query($sql, $params = [])
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Model Query Error: " . $e->getMessage());
            throw $e; // em produção você pode customizar
        }
    }

    /**
     * Busca todos os resultados
     */
    protected function fetchAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Busca apenas um registro
     */
    protected function fetch($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    /**
     * Executa (INSERT/UPDATE/DELETE)
     */
    protected function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }

    /**
     * Métodos de transação
     */
    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    public function commit()
    {
        return $this->db->commit();
    }

    public function rollBack()
    {
        return $this->db->rollBack();
    }
}
