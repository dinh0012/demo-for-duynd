<?php

class DB
{
    public static $instant;
    private $conn;
    public function __construct()
    {
        if ($this->conn) {
            return self::$instant;
        } else {
            try {
                $this->conn = new PDO("mysql:host=mysqldb;dbname=bank", 'root', 'root');
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

    public function getConnection() {
            return $this->conn;
    }
}
