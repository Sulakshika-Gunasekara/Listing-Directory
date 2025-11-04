<?php
// backend/app/Database.php

require_once __DIR__ . '/Config.php';

Config::load();

class Database {
    private static $instance = null;
    private $conn;

    private $host;
    private $user;
    private $pass;
    private $name;

    private function __construct() {
        $this->host = Config::get('DB_HOST');
        $this->user = Config::get('DB_USER');
        $this->pass = Config::get('DB_PASS');
        $this->name = Config::get('DB_NAME');
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log($e->getMessage() . "\n", 3, ROOT_PATH . 'backend/logs/db_errors.log');
            http_response_code(500);
            echo json_encode(['error' => 'Database connection failed.']);
            exit;
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>