<?php
// backend/routes/api.php

header('Content-Type: application/json');

file_put_contents(ROOT_PATH . 'backend/logs/api.log', "API request received: " . $_SERVER['REQUEST_URI'] . "\n", FILE_APPEND);

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/Http/Controllers/ListingController.php';
require_once __DIR__ . '/../app/Http/Controllers/CategoryController.php';
require_once __DIR__ . '/../App/Controllers/ServiceController.php';

$router = new Router();
$listingController = new ListingController();
$categoryController = new CategoryController();
$serviceController = new ServiceController();

$router->get('/listings', function() use ($listingController) {
    if (isset($_GET['category_id'])) {
        $listingController->getByCategory($_GET['category_id']);
    } else {
        $listingController->getAll();
    }
});

$router->get('/categories', function() use ($categoryController) {
    if (isset($_GET['parent_id'])) {
        $categoryController->getSubcategories($_GET['parent_id']);
    } else {
        $categoryController->getAll();
    }
});

$router->get('/services', function() use ($serviceController) {
    if (isset($_GET['category_id'])) {
        $serviceController->getByCategory($_GET['category_id']);
    } else {
        $serviceController->getAll();
    }
});

$router->resolve();
?>