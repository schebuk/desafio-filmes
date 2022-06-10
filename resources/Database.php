<?php

declare(strict_types=1);

namespace Resources;

use PDO;
use PDOException;
use PDOStatement;

final class Database
{
    private static string $type;
    private static string $host;
    private static string $database;
    private static string $user;
    private static string $pass;
    private static int $port;
    private string $table;
    private object $connection;

    public static function config(
        string $type,
        string $host,
        string $database,
        string $user,
        string $pass,
        int $port
    ): void {
        self::$type = $type;
        self::$host = $host;
        self::$database = $database;
        self::$user = $user;
        self::$pass = $pass;
        self::$port = $port;
    }

    public function __construct(string $table = null, ?string $tableJoin = null)
    {
        $this->table = $table;
        $this->tableJoin = $tableJoin;
        $this->iniciarConexao();
    }

    private function iniciarConexao(): void
    {
        try {
            $this->connection = new PDO(
                self::$type . ':host=' . self::$host . ';dbname=' . self::$database . ';charset=utf8;port=' . self::$port,
                self::$user,
                self::$pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro: ' . $e->getMessage());
        }
    }

    public function executar(string $query, array $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('Erro: ' . $e->getMessage());
        }
    }

    public function inserir(array $values): string
    {
        $fields = array_keys($values);
        $binds  = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        $this->executar($query, array_values($values));
        return $this->connection->lastInsertId();
    }

    public function selecionar(
        string $where = null,
        string $order = null,
        string $limit = null,
        string $fields = '*'
    ) {
        if (!empty($where)) {
            $where = strlen($where) ? 'WHERE ' . $where : '';
        }
        if (!empty($order)) {
            $order = strlen($order) ? 'ORDER BY ' . $order : '';
        }
        if (!empty($limit)) {
            $limit = strlen($limit) ? 'LIMIT ' . $limit : '';
        }
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        return $this->executar($query);
    }

    public function atualizar($where, $values)
    {
        $fields = array_keys($values);
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;
        $this->executar($query, array_values($values));
        return true;
    }

    public function excluir(string $where): bool
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $this->executar($query);
        return true;
    }

    public function softDelete(string $where): bool
    {
        $query = 'UPDATE ' . $this->table . ' SET deleted_at = NOW() WHERE ' . $where;
        $this->executar($query);
        return true;
    }
}
