<?php

$storagePath = '/tmp/storage';
$cachePath = '/tmp/bootstrap/cache';

// Create writable directories in /tmp
if (!is_dir($storagePath)) {
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/logs', 0755, true);
}

if (!is_dir($cachePath)) {
    mkdir($cachePath, 0755, true);
}

// Redirect storage and bootstrap cache paths
putenv("APP_STORAGE={$storagePath}");
putenv("APP_CONFIG_CACHE={$cachePath}/config.php");
putenv("APP_SERVICES_CACHE={$cachePath}/services.php");
putenv("APP_PACKAGES_CACHE={$cachePath}/packages.php");
putenv("APP_ROUTES_CACHE={$cachePath}/routes.php");
putenv("APP_EVENTS_CACHE={$cachePath}/events.php");
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");

require __DIR__ . '/../public/index.php';