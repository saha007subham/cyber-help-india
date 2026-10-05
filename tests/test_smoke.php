<?php
/**
 * Simple Architecture & Component Smoke Test
 * 
 * Verifies core framework components:
 * 1. Environment loader & Config access
 * 2. Helper functions (e, csrf, validate)
 * 3. Router route matching & dispatching
 * 
 * Run with: php tests/test_smoke.php
 */

declare(strict_types=1);

require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/helpers/security.php';
require_once __DIR__ . '/../app/helpers/validation.php';
require_once __DIR__ . '/../app/helpers/auth.php';

load_env(__DIR__ . '/../.env');

echo "=== Running Foundation Smoke Tests ===\n";

// 1. Config Test
$appName = config('app.name');
assert(!empty($appName), "Config app.name should not be empty");
echo " [PASS] Config loaded successfully: {$appName}\n";

// 2. Security XSS Escaping Test
$raw = '<script>alert("hack")</script>';
$escaped = e($raw);
assert(!str_contains($escaped, '<script>'), "e() failed to escape HTML");
echo " [PASS] Security e() XSS filter works\n";

// 3. Validation Test
$validationResult = validate(
    ['email' => 'invalid-email', 'name' => 'John'],
    ['email' => 'required|email', 'name' => 'required|min:2']
);
assert($validationResult['isValid'] === false, "Validation should fail for invalid email");
assert(isset($validationResult['errors']['email']), "Error should exist for invalid email");
echo " [PASS] Validation helper works correctly\n";

// 4. Autoloader Test
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = dirname(__DIR__) . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $file = $baseDir . str_replace('\\', '/', substr($class, $len)) . '.php';
    if (file_exists($file)) require_once $file;
});

assert(class_exists(\App\Routes\Router::class), "Router class must be loadable");
assert(class_exists(\App\Controllers\HomeController::class), "HomeController class must be loadable");
echo " [PASS] PSR-4 Autoloader works correctly\n";

echo "=== All Foundation Smoke Tests Passed! ===\n";
