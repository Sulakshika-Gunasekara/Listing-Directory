<?php
// backend/public/index.php

define('ROOT_PATH', dirname(__DIR__) . '/');

// Optional: display PHP errors (for local debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include your main API route definitions
require_once ROOT_PATH . 'routes/api.php';
?>