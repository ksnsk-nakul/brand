<?php

// Populate environment variables for Laravel's env() helper
foreach ($_SERVER as $key => $value) {
    if (is_string($value) && (str_starts_with($key, 'APP_') || str_starts_with($key, 'DB_') || str_starts_with($key, 'SESSION_') || str_starts_with($key, 'CACHE_') || str_starts_with($key, 'LOG_'))) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
    }
}

$storagePath = '/tmp/storage';
$cachePath = '/tmp/bootstrap/cache';

// Prepare writable /tmp directories
if (!is_dir($storagePath)) {
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/logs', 0755, true);
}

if (!is_dir($cachePath)) {
    mkdir($cachePath, 0755, true);
}

// Redirect storage and cache pointers to /tmp
putenv("APP_STORAGE={$storagePath}");
putenv("APP_CONFIG_CACHE={$cachePath}/config.php");
putenv("APP_SERVICES_CACHE={$cachePath}/services.php");
putenv("APP_PACKAGES_CACHE={$cachePath}/packages.php");
putenv("APP_ROUTES_CACHE={$cachePath}/routes.php");
putenv("APP_EVENTS_CACHE={$cachePath}/events.php");
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");

require __DIR__ . '/../public/index.php';