<?php
// backend/routes/api.php

header('Content-Type: application/json');

file_put_contents(ROOT_PATH . 'backend/logs/api.log', "API request received: " . $_SERVER['REQUEST_URI'] . "\n", FILE_APPEND);

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/Http/Controllers/ListingController.php';
require_once __DIR__ . '/../app/Http/Controllers/CategoryController.php';
require_once __DIR__ . '/../App/Controllers/ServiceController.php';
require_once __DIR__ . '/../App/Controllers/ReviewController.php';

$router = new Router();
$listingController = new ListingController();
$categoryController = new CategoryController();
$serviceController = new ServiceController();
$reviewController = new ReviewController();

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

// Reviews routes
$router->get('/reviews', function() use ($reviewController) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $reviewController->show($_GET['id']);
        } else {
            $reviewController->index();
        }
    }
});

$router->post('/reviews', function() use ($reviewController) {
    $reviewController->store();
});

$router->put('/reviews', function() use ($reviewController) {
    if (isset($_GET['id'])) {
        $reviewController->update($_GET['id']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Missing review ID.']);
    }
});

$router->delete('/reviews', function() use ($reviewController) {
    if (isset($_GET['id'])) {
        $reviewController->destroy($_GET['id']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Missing review ID.']);
    }
});


$router->resolve();
?>