<?php

namespace App\Config;

use PDO;
use Dotenv\Dotenv;

class Database {
    private string $host;
    private string $port;
    private string $dbname;
    private string $username;
    private string $password;
    private ?PDO $connection = null;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();

        $this->host = $_ENV['DB_HOST'] ?? '127.0.0.1'; 
        $this->port = $_ENV['DB_PORT'] ?? '3306';
        $this->dbname = $_ENV['DB_DATABASE'] ?? 'test';
        $this->username = $_ENV['DB_USERNAME'] ?? 'root';
        $this->password = $_ENV['DB_PASSWORD'] ?? '';
    }

    public function connect(): PDO {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";
                $this->connection = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (\PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return $this->connection;
    }
}
