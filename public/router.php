<?php
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Check if it's a real file or directory
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false; // Return the file
}

// Otherwise, route through index.php
require_once __DIR__ . '/index.php';
