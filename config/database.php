<?php
class Database
{
    private $host = 'localhost', $dbname = 'db_test_programmer', $user = 'user_test_programmer', $pass = 'pass_test_programmer';
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
        } catch (PDOException $e) {
            die("Connection Error : " . $e->getMessage());
        }
        return $this->conn;
    }
}
