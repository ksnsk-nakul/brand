<?php

// Vercel serverless functions have a read-only filesystem.
// Direct writable storage paths to /tmp
$storagePath = '/tmp/storage';

if (!is_dir($storagePath)) {
    mkdir($storagePath, 0755, true);
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/logs', 0755, true);
}

putenv("APP_STORAGE={$storagePath}");
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");

// Forward the request to Laravel's original public/index.php
require __DIR__ . '/../public/index.php';