<?php
// index.php - Front Controller

// Start the session
session_start();

// Define base path
define('BASE_PATH', __DIR__);

// Include the routes
require_once BASE_PATH . '/routes.php';

// Parse the URL
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Remove base folder from path if needed
// Adjust this line based on your server setup
$base_folder = '/tp_mvc'; // Change this to your actual base folder if different
if (strpos($path, $base_folder) === 0) {
    $path = substr($path, strlen($base_folder));
}

// Default route if nothing is specified
if ($path == '/' || $path == '') {
    $path = '/';
}

// Route the request
$found = false;
foreach ($routes as $route => $handler) {
    // Convert simple route patterns to regex
    $pattern = '#^' . str_replace('/', '\/', $route) . '$#';
    
    if (preg_match($pattern, $path, $matches)) {
        // Extract controller and action
        list($controller_name, $action) = $handler;
        
        // Remove the first match (the full string)
        array_shift($matches);
        
        // Include the controller file
        $controller_file = BASE_PATH . '/controllers/' . $controller_name . '.php';
        
        if (file_exists($controller_file)) {
            require_once $controller_file;
            
            // Create controller instance
            $controller = new $controller_name();
            
            // Call the action with parameters
            call_user_func_array([$controller, $action], $matches);
            
            $found = true;
            break;
        }
    }
}

// If no route was found
if (!$found) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>The page you requested could not be found.</p>";
    echo "<p><a href='$base_folder/'>Return to Home</a></p>";
}