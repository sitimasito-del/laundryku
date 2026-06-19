<?php

// Set error reporting for production
if (getenv('APP_ENV') === 'production') {
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
}

try {
    require __DIR__.'/../public/index.php';
} catch (Throwable $e) {
    $logDir = __DIR__.'/../storage/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    
    $errorMessage = sprintf(
        "[%s] %s\n%s\n---\n",
        date('Y-m-d H:i:s'),
        $e->getMessage(),
        $e->getTraceAsString()
    );
    
    @file_put_contents($logDir . '/vercel-error.log', $errorMessage, FILE_APPEND);
    
    http_response_code(500);
    echo 'Internal Server Error. Check logs.';
}