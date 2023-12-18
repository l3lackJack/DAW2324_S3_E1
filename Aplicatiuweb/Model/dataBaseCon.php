<?php
class Database {
    private $host = 'mariadb';
    private $database = 'project';
    private $username = 'root';
    private $password = 'admin1234';
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;unix_socket=/var/run/mysqld/mysqld.sock", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
?>