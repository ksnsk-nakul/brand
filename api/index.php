<?php

// Force HTTPS header detection for serverless proxy execution
$_SERVER['HTTPS'] = 'on';
$_SERVER['SERVER_PORT'] = 443;
$_SERVER['HTTP_X_FORWARDED_PROTO'] = 'https';

foreach ($_SERVER as $key => $value) {
    if (is_string($value)) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
    }
}

$storagePath = '/tmp/storage';
$cachePath = '/tmp/bootstrap/cache';

$dirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    $cachePath,
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

putenv("APP_STORAGE={$storagePath}");
putenv("APP_CONFIG_CACHE={$cachePath}/config.php");
putenv("APP_SERVICES_CACHE={$cachePath}/services.php");
putenv("APP_PACKAGES_CACHE={$cachePath}/packages.php");
putenv("APP_ROUTES_CACHE={$cachePath}/routes.php");
putenv("APP_EVENTS_CACHE={$cachePath}/events.php");
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");

if (!getenv('APP_CIPHER')) {
    putenv('APP_CIPHER=AES-256-CBC');
    $_ENV['APP_CIPHER'] = 'AES-256-CBC';
}

require __DIR__ . '/../public/index.php';