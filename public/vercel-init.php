<?php

/**
 * Vercel Laravel Initialization Helper
 * This file is loaded before the actual Laravel application
 */

// Ensure storage directories are writable
$storageDir = __DIR__ . '/../storage';
$bootstrapCacheDir = __DIR__ . '/../bootstrap/cache';

// Create directories if they don't exist
if (!is_dir($storageDir)) {
    @mkdir($storageDir, 0755, true);
}
if (!is_dir($bootstrapCacheDir)) {
    @mkdir($bootstrapCacheDir, 0755, true);
}

// Ensure subdirectories exist
$dirs = [
    $storageDir . '/app',
    $storageDir . '/framework',
    $storageDir . '/logs',
    $bootstrapCacheDir,
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Set timezone
date_default_timezone_set('UTC');
