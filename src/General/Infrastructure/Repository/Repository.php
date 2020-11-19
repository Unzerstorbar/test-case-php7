<?php

namespace General\Infrastructure\Repository;

use PDO;
use PDOException;
use PDOStatement;

abstract class Repository
{
    protected PDO $db;

    public static function create(): self
    {
        return new static();
    }

    /**
     * Repository constructor
     */
    private function __construct()
    {
        try {
            $this->db = new PDO(
                "mysql:host={$_ENV['MYSQL_HOST']};port={$_ENV['MYSQL_PORT']};dbname={$_ENV['MYSQL_DATABASE']}",
                $_ENV['MYSQL_USER'],
                $_ENV['MYSQL_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        } catch (PDOException $e) {
        }
    }

    public function query($stmt): PDOStatement
    {
        return $this->db->query($stmt);
    }

    public function prepare($stmt): PDOStatement
    {
        return $this->db->prepare($stmt);
    }

    public function lastInsertId(): string
    {
        return $this->db->lastInsertId();
    }

    public function run(string $query, array $args = []): PDOStatement
    {
        try {
            if (!$args) {
                return $this->query($query);
            }
            $stmt = $this->prepare($query);
            $stmt->execute($args);
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function getRows(string $query, array $args = []): array
    {
        return $this->run($query, $args)->fetchAll();
    }

    public function getRow(string $query, array $args = [])
    {
        return $this->run($query, $args)->fetch();
    }
}
