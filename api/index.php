<?php

define('LARAVEL_START', microtime(true));

// Simple and reliable entry point for Vercel
try {
    // Ensure storage directories exist
    $dirs = [
        __DIR__.'/../storage',
        __DIR__.'/../storage/app',
        __DIR__.'/../storage/framework',
        __DIR__.'/../storage/framework/cache',
        __DIR__.'/../storage/framework/sessions',
        __DIR__.'/../storage/logs',
        __DIR__.'/../bootstrap/cache',
    ];
    
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
    }
    
    // Load Laravel
    require __DIR__.'/../public/index.php';
    
} catch (Throwable $e) {
    // Log error
    $logFile = __DIR__.'/../storage/logs/vercel-error.log';
    $dir = dirname($logFile);
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
    
    $timestamp = date('Y-m-d H:i:s');
    $error = "[$timestamp] " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n---\n";
    @file_put_contents($logFile, $error, FILE_APPEND);
    
    // Output error
    http_response_code(500);
    
    if (getenv('APP_DEBUG') === 'true') {
        echo $e->getMessage() . "\n\n";
        echo $e->getTraceAsString();
    } else {
        echo "Internal Server Error";
    }
    
    exit(1);
}