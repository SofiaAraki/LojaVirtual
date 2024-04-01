<?php
class Database {
    private $driver;
    private $host;
    private $dbname;
    private $username;
    private $password;

    private $conn;

    function __construct() {
        $this->driver = "mysql";
        $this->host = "localhost";
        $this->dbname = "test";
        $this->username = "root";
        $this->password = "";
    }

    function getConexao() {
        try {
            $this->conn = new PDO(
                "$this->driver:host=$this->host;dbname=$this->dbname",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        } catch (PDOException $e) {
            // Em caso de erro, exibe a mensagem de erro
            echo "Erro de conexão: " . $e->getMessage();
            // Exibe informações adicionais para depuração
            var_dump($this->driver, $this->host, $this->username, $this->password, $this->dbname);
        }
        
    }
}

// Testando a conexão
$database = new Database();
$conn = $database->getConexao();
