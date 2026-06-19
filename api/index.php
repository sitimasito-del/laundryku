<?php

// Set error reporting for production
if (getenv('APP_ENV') === 'production') {
    error_reporting(0);
    ini_set('display_errors', '0');
}

try {
    require __DIR__.'/../public/index.php';
} catch (Exception $e) {
    error_log('Laravel Error: ' . $e->getMessage());
    error_log($e->getTraceAsString());
    
    http_response_code(500);
    die('Internal Server Error. Check logs.');
}