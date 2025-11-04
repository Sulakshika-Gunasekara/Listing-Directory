<?php
// backend/app/Models/Listing.php

require_once __DIR__ . '/../Database.php';

class Listing {
    private $conn;
    private $table = 'listings';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCategory($categoryId) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE category_id = :category_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>