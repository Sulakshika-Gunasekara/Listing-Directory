<?php
// backend/app/Models/Category.php

require_once __DIR__ . '/../Database.php';

class Category {
    private $conn;
    private $table = 'categories';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE parent_id IS NULL';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubcategories($parentId) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE parent_id = :parent_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':parent_id', $parentId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>