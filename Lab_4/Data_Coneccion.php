<?php
class DatabaseConnection {
    private $host = 'localhost';
    private $dbname = 'db_mascotas';
    private $username = 'root';
    private $password = 'anyelina2010';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host; dbname=$this->dbname",
            $this->username,
            $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>