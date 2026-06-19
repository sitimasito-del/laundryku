<?php

// For Vercel debugging - show actual errors
define('LARAVEL_START', microtime(true));

try {
    // Ensure required directories exist
    $baseDir = __DIR__.'/../';
    $dirs = [
        'storage',
        'storage/logs',
        'storage/framework',
        'storage/framework/cache',
        'storage/framework/sessions',
        'storage/framework/views',
        'storage/app',
        'bootstrap/cache',
    ];
    
    foreach ($dirs as $dir) {
        $fullPath = $baseDir . $dir;
        if (!is_dir($fullPath)) {
            @mkdir($fullPath, 0777, true);
        }
    }
    
    // Check if vendor/autoload.php exists
    $autoload = $baseDir . 'vendor/autoload.php';
    if (!file_exists($autoload)) {
        throw new Exception("vendor/autoload.php not found at: $autoload");
    }
    
    require $baseDir . 'public/index.php';
    
} catch (Throwable $e) {
    http_response_code(500);
    
    // Output error for debugging
    $isDev = (getenv('APP_ENV') !== 'production');
    
    if ($isDev) {
        echo "Error: " . $e->getMessage() . "\n";
        echo $e->getTraceAsString();
    } else {
        echo "Internal Server Error";
    }
    
    // Also log it
    $logDir = __DIR__.'/../storage/logs';
    @mkdir($logDir, 0777, true);
    
    $msg = sprintf(
        "[%s] Error: %s\nFile: %s:%d\nTrace:\n%s\n---\n",
        date('Y-m-d H:i:s'),
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        $e->getTraceAsString()
    );
    
    @file_put_contents($logDir . '/vercel-error.log', $msg, FILE_APPEND);
    
    exit(1);
}