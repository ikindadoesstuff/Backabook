<?php

// Get the requested URI and remove query parameters
$route = strtok($_SERVER['REQUEST_URI'], '?');

// Remove leading slash if present
$route = ltrim($route, '/');

// Default to index.php if no route is provided
$route = $route !== "" ? $route : "index.php";

// Construct the full path to the requested file
$path = realpath(__DIR__ . "/../" . $route);

// Ensure the file exists and is within the allowed directory
$baseDir = realpath(__DIR__ . "/../");
if ($path && strpos($path, $baseDir) === 0 && file_exists($path)) {
    // Check if the file is a PHP file
    // if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
        require $path;
    // } else {
    //     // Serve non-PHP files for download
    //     $mimeType = 'application/octet-stream'; // Default MIME type for unknown files
    //     header("X-Sendfile: $path");
    //     header("Content-type: $mimeType");
    //     header('Content-Disposition: attachment; filename="' . basename($path) . '"');
    //     exit;
    // }
} else {
    // Handle 404 error
    http_response_code(404);
    echo "404 Not Found";
}