<?php

// Reduce initialization overhead for faster cold starts
define('LARAVEL_START', microtime(true));

// Set error reporting for production
if (getenv('APP_ENV') === 'production') {
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
}

try {
    // Initialize filesystem check
    $baseDir = __DIR__.'/../';
    $requiredDirs = [
        'storage/logs',
        'storage/framework/cache',
        'storage/framework/sessions',
        'bootstrap/cache',
    ];
    
    foreach ($requiredDirs as $dir) {
        $fullPath = $baseDir . $dir;
        if (!is_dir($fullPath)) {
            @mkdir($fullPath, 0755, true);
        }
    }
    
    require $baseDir . 'public/index.php';
} catch (Throwable $e) {
    $logDir = __DIR__.'/../storage/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    
    $errorMessage = sprintf(
        "[%s] Cold Start Error\n%s\n%s\n---\n",
        date('Y-m-d H:i:s'),
        $e->getMessage(),
        $e->getTraceAsString()
    );
    
    @file_put_contents($logDir . '/vercel-error.log', $errorMessage, FILE_APPEND);
    
    http_response_code(500);
    echo 'Internal Server Error';
}