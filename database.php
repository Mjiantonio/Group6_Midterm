<?php
class Database {
    private $host = "localhost";
    private $db_name = "EventManagementSystem";
    private $username = "postgres";
    private $password = "271630";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            error_log($exception->getMessage());
        }
        return $this->conn;
    }
}