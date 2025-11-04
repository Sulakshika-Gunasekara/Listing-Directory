<?php
// backend/app/Http/Controllers/CategoryController.php

require_once __DIR__ . '/../../Models/Category.php';

class CategoryController {
    private $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function getAll() {
        $categories = $this->category->getAll();
        echo json_encode($categories);
    }

    public function getSubcategories($parentId) {
        $categories = $this->category->getSubcategories($parentId);
        echo json_encode($categories);
    }
}
?>