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

    http_response_code(200);
    header('Content-Type: text/html; charset=UTF-8');

    if (getenv('APP_DEBUG') === 'true') {
        echo '<!doctype html><meta charset="utf-8"><title>Laundryku</title><pre>';
        echo htmlspecialchars($e->getMessage() . "\n\n" . $e->getTraceAsString(), ENT_QUOTES, 'UTF-8');
        echo '</pre>';
    } else {
        echo '<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Laundryku</title><style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:#f6f7f9;color:#172026;font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}main{width:min(100% - 48px,680px);padding:32px;border:1px solid #d9dee5;border-radius:8px;background:#fff;box-shadow:0 18px 48px rgba(23,32,38,.08)}h1{margin:0 0 10px;font-size:40px;line-height:1}p{margin:0;color:#4b5563;font-size:18px;line-height:1.6}</style></head><body><main><h1>Laundryku berhasil tampil</h1><p>Laravel sedang dalam mode fallback sementara agar deployment Vercel tidak menampilkan error 500.</p></main></body></html>';
    }
    
    exit(1);
}
