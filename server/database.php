<?php

class Database {

    private $hostname = "localhost";
    private $database = "swlivraria";
    private $username = "root";
    private $password = "";

    public $pdo;

    public function __construct() {
        $this->ConnectionPDO();
    }

    private function ConnectionPDO() {
        try {
            $conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET NAMES 'utf8';");

            $this->pdo = $conn;
        } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }

}