<?php
/**
 * Front Controller & Application Entry Point
 * 
 * All HTTP requests flow through this file:
 * Request -> public/index.php -> routes/web.php -> Controller -> Model -> View -> Response
 */

declare(strict_types=1);

define('APP_START', microtime(true));
define('APP_ROOT', dirname(__DIR__));

// =============================================================================
// 1. PSR-4 Autoloader
// =============================================================================
if (file_exists(APP_ROOT . '/vendor/autoload.php')) {
    require_once APP_ROOT . '/vendor/autoload.php';
} else {
    // Native PSR-4 fallback autoloader for the "App\" namespace
    spl_autoload_register(function (string $class): void {
        $prefix = 'App\\';
        $baseDir = APP_ROOT . '/app/';
        $prefixLength = strlen($prefix);

        if (strncmp($prefix, $class, $prefixLength) !== 0) {
            return;
        }

        $relativeClass = substr($class, $prefixLength);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    });

    // Manually load core helper files if vendor/autoload.php is not present
    require_once APP_ROOT . '/app/helpers/functions.php';
    require_once APP_ROOT . '/app/helpers/security.php';
    require_once APP_ROOT . '/app/helpers/validation.php';
    require_once APP_ROOT . '/app/helpers/auth.php';
}

// =============================================================================
// 2. Load Environment Variables (.env)
// =============================================================================
load_env(APP_ROOT . '/.env');

// =============================================================================
// 3. Security Headers & Session Initialization
// =============================================================================
send_security_headers();
start_secure_session();

// =============================================================================
// 4. Centralized Error & Exception Handling
// =============================================================================
$isDebug = (bool) config('app.debug', false);

if ($isDebug) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Convert warnings/notices to ErrorException
set_error_handler(function (int $severity, string $message, string $file, int $line): bool {
    if (!(error_reporting() & $severity)) {
        return false;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
});

// Central Exception Handler
set_exception_handler(function (Throwable $exception) use ($isDebug): void {
    // Log exception details to storage/logs/app.log
    $logDirectory = APP_ROOT . '/storage/logs';
    if (!is_dir($logDirectory)) {
        @mkdir($logDirectory, 0755, true);
    }

    $logFile = $logDirectory . '/app.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = sprintf(
        "[%s] %s: %s in %s on line %d\nStack trace:\n%s\n%s\n",
        $timestamp,
        get_class($exception),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        $exception->getTraceAsString(),
        str_repeat('-', 80)
    );
    @error_log($logEntry, 3, $logFile);

    http_response_code(500);

    if ($isDebug) {
        require_once APP_ROOT . '/app/views/errors/debug.php';
    } else {
        require_once APP_ROOT . '/app/views/errors/500.php';
    }
    exit;
});

// =============================================================================
// 5. Load Routes & Dispatch HTTP Request
// =============================================================================
require_once APP_ROOT . '/app/routes/web.php';

use App\Routes\Router;

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

Router::dispatch($requestUri, $requestMethod);
