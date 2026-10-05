<?php
/**
 * Application Configuration
 * 
 * Returns the primary configuration array for the application.
 * Values are retrieved from the environment (.env) with safe defaults.
 */

declare(strict_types=1);

// Ensure .env is loaded if helper is available
if (function_exists('load_env')) {
    load_env(dirname(__DIR__, 2) . '/.env');
}

return [
    'app' => [
        'name'  => env('APP_NAME', 'Cyber Help India'),
        'env'   => env('APP_ENV', 'production'),
        'debug' => (bool) env('APP_DEBUG', false),
        'url'   => env('APP_URL', 'http://localhost:8000'),
    ],

    'database' => [
        'host'     => env('DB_HOST', '127.0.0.1'),
        'port'     => (int) env('DB_PORT', 3306),
        'database' => env('DB_DATABASE', 'cyber_help_db'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset'  => env('DB_CHARSET', 'utf8mb4'),
    ],

    'session' => [
        'name'     => 'cyberhelp_session',
        'lifetime' => 0,
        'path'     => '/',
        'samesite' => 'Lax',
    ],

    'paths' => [
        'root'    => dirname(__DIR__, 2),
        'app'     => dirname(__DIR__),
        'public'  => dirname(__DIR__, 2) . '/public',
        'storage' => dirname(__DIR__, 2) . '/storage',
        'views'   => dirname(__DIR__) . '/views',
    ],
];
