<?php
// require_once __DIR__ . '/config.php';

class Database
{

    private $host;
    private $port;
    private $dbname;
    private $user;
    private $password;
    private $charset = "utf8mb4";

    public function __construct()
    {
        $config = require __DIR__ . '/config.php';

        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->dbname = $config['database'];
        $this->user = $config['username'];
        $this->password = $config['password'];
    }
    public function conectar()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            $pdo = new PDO(
                $dsn,
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}