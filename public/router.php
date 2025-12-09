<?php
// Get the requested URI
$requestUri = $_SERVER['REQUEST_URI'];
$publicPath = __DIR__;

// Remove query string
$path = parse_url($requestUri, PHP_URL_PATH);

// Check if requesting a file (for static assets)
if ($path !== '/' && file_exists($publicPath . $path)) {
    // Serve the file directly
    return false;
}

// Otherwise, route to Laravel via index.php
require_once __DIR__ . '/index.php';
