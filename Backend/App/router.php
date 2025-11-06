<?php
// backend/app/Router.php

class Router {
    private $routes = [];
    
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }
    
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }
    
    public function put($path, $callback) {
        $this->routes['PUT'][$path] = $callback;
    }
    
    public function delete($path, $callback) {
        $this->routes['DELETE'][$path] = $callback;
    }
    
    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Handle PUT and DELETE methods sent via POST with _method parameter
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }
        
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);
        
        // Log original path for debugging
        file_put_contents(ROOT_PATH . 'backend/logs/api.log', "Original URI: $uri\n", FILE_APPEND);
        file_put_contents(ROOT_PATH . 'backend/logs/api.log', "Original Path: $path\n", FILE_APPEND);
        
        // Remove base path (adjust based on your setup)
        $basePath = '/backend/public';
        $path = str_replace($basePath, '', $path);
        
        // Remove /api/ prefix if present
        $path = preg_replace('#^/api#', '', $path);
        
        // Log for debugging
        file_put_contents(ROOT_PATH . 'backend/logs/api.log', "Method: $method, Final Path: $path\n", FILE_APPEND);
        file_put_contents(ROOT_PATH . 'backend/logs/api.log', "Available routes: " . print_r(array_keys($this->routes), true) . "\n", FILE_APPEND);
        
        // Check if route exists
        if (isset($this->routes[$method][$path])) {
            call_user_func($this->routes[$method][$path]);
        } else {
            // Debug output
            $debug = [
                'error' => 'Route not found',
                'path' => $path,
                'method' => $method,
                'available_routes' => $this->routes,
                'original_uri' => $uri
            ];
            http_response_code(404);
            echo json_encode($debug);
        }
    }
}
?>