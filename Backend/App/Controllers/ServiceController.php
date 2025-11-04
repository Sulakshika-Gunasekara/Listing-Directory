<?php

require_once __DIR__ . '/../Models/Service.php';

class ServiceController {
    private $service;

    public function __construct() {
        $this->service = new Service();
    }

    public function getAll() {
        $services = $this->service->getAll();
        echo json_encode($services);
    }

    public function getByCategory($categoryId) {
        $services = $this->service->getByCategoryId($categoryId);
        echo json_encode($services);
    }
}
?>