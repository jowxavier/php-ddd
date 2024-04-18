<?php

namespace App\DomainDrivenDesign\Infrastructure\Database;

use PDO;
use Exception;

class PdoConnection
{
    protected $pdo;

    public function __construct(
        private $host = "mysql",
        private $dbname = "ddd-example",
        private $username = "root",
        private $password = "secret",
        private $charset = "utf8"
    ) {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}", $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => TRUE
            ]);
        } catch (PDOException $e) {
            throw  new Exception($e->getMessage());
        }
    }
}