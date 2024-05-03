<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class DB
{
    private static ?DB $instance;
    private PDO $connection;

    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4";
            $this->connection = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public static function getInstance(): ?static
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public static function execute(string $query, array $params = []): PDOStatement
    {
        $instance = self::getInstance();
        $stmt = $instance->getConnection()->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }
}
