<?php

define('LARAVEL_START', microtime(true));

try {
    $storagePath = sys_get_temp_dir().'/laravel-storage';

    $dirs = [
        $storagePath,
        $storagePath.'/app',
        $storagePath.'/framework',
        $storagePath.'/framework/cache',
        $storagePath.'/framework/cache/data',
        $storagePath.'/framework/sessions',
        $storagePath.'/framework/views',
        $storagePath.'/logs',
        __DIR__.'/../bootstrap/cache',
    ];

    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
    }

    $_ENV['LARAVEL_STORAGE_PATH'] = $storagePath;
    $_SERVER['LARAVEL_STORAGE_PATH'] = $storagePath;

    if (file_exists($maintenance = $storagePath.'/framework/maintenance.php')) {
        require $maintenance;
    }

    require __DIR__.'/../vendor/autoload.php';

    /** @var Illuminate\Foundation\Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (Throwable $e) {
    $logFile = (sys_get_temp_dir().'/laravel-storage/logs/vercel-error.log');
    $dir = dirname($logFile);
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }

    $timestamp = date('Y-m-d H:i:s');
    $error = "[$timestamp] " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n---\n";
    @file_put_contents($logFile, $error, FILE_APPEND);

    http_response_code(500);

    if (getenv('APP_DEBUG') === 'true') {
        echo $e->getMessage() . "\n\n";
        echo $e->getTraceAsString();
    } else {
        echo "Internal Server Error";
    }
    
    exit(1);
}
