<?php

class Database {
    private static $instance = null;
    private $conn;
    private $host;
    private $dbName;
    private $username;
    private $password;

    public function __construct() {
        try {
            $this->host = $_ENV['PMA_HOST'];
            $this->dbName = $_ENV['MYSQL_DATABASE'];
            $this->username = $_ENV['MYSQL_USER'];
            $this->password = $_ENV['MYSQL_PASSWORD'];



            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}